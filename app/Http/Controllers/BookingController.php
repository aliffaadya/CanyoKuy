<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Schedule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    // ==================== VIEW METHODS ====================
    
    public function index()
    {
        $bookings = Booking::orderBy('created_at', 'desc')->get();
        return view('admin.booking', compact('bookings'));
    }

    // ==================== API METHODS ====================
    
    // Get all bookings for API
    public function getAllBookings()
    {
        try {
            $bookings = Booking::orderBy('created_at', 'desc')->get();
            return response()->json([
                'success' => true,
                'data' => $bookings
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // Get booking statistics (including rejected)
    public function getStats()
    {
        try {
            $stats = [
                'pending' => Booking::where('payment_status', 'pending')->count(),
                'waiting_confirmation' => Booking::where('payment_status', 'waiting_confirmation')->count(),
                'paid' => Booking::where('payment_status', 'paid')->count(),
                'rejected' => Booking::where('payment_status', 'rejected')->count(),
                'total' => Booking::count()
            ];
            
            return response()->json([
                'success' => true,
                'data' => $stats
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // Get single booking
    public function getBooking($id)
    {
        try {
            $booking = Booking::findOrFail($id);
            return response()->json([
                'success' => true,
                'data' => $booking
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Booking tidak ditemukan'
            ], 404);
        }
    }

    // Get bookings by status
    public function getBookingsByStatus($status)
    {
        try {
            $validStatuses = ['pending', 'waiting_confirmation', 'paid', 'rejected', 'cancelled'];
            
            if (!in_array($status, $validStatuses)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Status tidak valid'
                ], 400);
            }
            
            $bookings = Booking::where('payment_status', $status)
                ->orderBy('created_at', 'desc')
                ->get();
                
            return response()->json([
                'success' => true,
                'data' => $bookings
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // Store new booking
    public function store(Request $request)
    {
        try {
            \Log::info('Booking data:', $request->all());

            $request->validate([
                'nama' => 'required|string|max:100',
                // 'email' => 'nullable|email|max:100', // Email boleh kosong
                'whatsapp' => 'required|string|max:20',
                'paket' => 'required|string',
                'tanggal' => 'required|date',
                'total' => 'required|integer',
                'catatan' => 'nullable|string',
                'bukti_transfer' => 'nullable|image|mimes:jpeg,jpg,png|max:2048'
            ]);

            // Generate kode booking unik
            $bookingCode = 'CYK' . date('Ymd') . rand(100, 999);
            
            // Cek kode booking duplikat
            while (Booking::where('booking_code', $bookingCode)->exists()) {
                $bookingCode = 'CYK' . date('Ymd') . rand(100, 999);
            }

            // Buat folder jika belum ada
            if (!Storage::disk('public')->exists('payment_proofs')) {
                Storage::disk('public')->makeDirectory('payment_proofs');
            }

            // Upload bukti transfer
            $paymentProof = null;
            if ($request->hasFile('bukti_transfer')) {
                $file = $request->file('bukti_transfer');
                $filename = time() . '_' . $bookingCode . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('payment_proofs', $filename, 'public');
                $paymentProof = '/storage/' . $path;
            }

            DB::beginTransaction();

            // Cari schedule dengan LOCK untuk mencegah race condition
            $schedule = Schedule::where('schedule_date', $request->tanggal)
                ->lockForUpdate()
                ->first();

            if (!$schedule) {
                $schedule = Schedule::create([
                    'schedule_date' => $request->tanggal,
                    'quota' => 20,
                    'filled' => 0,
                    'is_active' => true
                ]);
            }

            // CEK KUOTA
            $remainingQuota = $schedule->quota - $schedule->filled;
            if ($remainingQuota <= 0) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Maaf, kuota untuk tanggal ' . date('d-m-Y', strtotime($request->tanggal)) . ' sudah penuh!'
                ], 400);
            }

            // Update kuota
            $schedule->increment('filled');

            // Set nilai DP (50% dari total)
            $dpAmount = $request->total * 0.5;
            $remainingAmount = $request->total * 0.5;

            // Simpan booking
            $booking = Booking::create([
                'booking_code' => $bookingCode,
                'package_name' => $request->paket,
                'customer_name' => $request->nama,
                'email' => $request->email ?? '-', // Jika email null, isi dengan '-'
                'phone' => $request->whatsapp,
                'participants' => 1,
                'booking_date' => $request->tanggal,
                'total_price' => $request->total,
                'dp_amount' => $dpAmount,
                'remaining_amount' => $remainingAmount,
                'notes' => $request->catatan,
                'payment_proof' => $paymentProof,
                'payment_status' => 'waiting_confirmation'
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Booking berhasil! Silakan tunggu verifikasi dari admin.',
                'booking_code' => $bookingCode,
                'remaining_quota' => $schedule->quota - $schedule->filled,
                'data' => $booking
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal: ' . $e->getMessage(),
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Booking error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    // Update booking status (verify, reject, etc)
    public function updateStatus(Request $request, $id)
    {
        try {
            $booking = Booking::findOrFail($id);
            $newStatus = $request->status;
            
            $validStatuses = ['pending', 'waiting_confirmation', 'paid', 'rejected', 'cancelled'];
            if (!in_array($newStatus, $validStatuses)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Status tidak valid'
                ], 400);
            }
            
            // Jika status berubah dari rejected ke waiting_confirmation
            if ($booking->payment_status === 'rejected' && $newStatus === 'waiting_confirmation') {
                $booking->rejection_reason = null;
                $booking->rejected_at = null;
            }
            
            // Jika status baru adalah rejected
            if ($newStatus === 'rejected') {
                $booking->rejected_at = now();
            }
            
            // Jika status berubah menjadi paid (verifikasi), catat waktu verifikasi
            if ($newStatus === 'paid' && $booking->payment_status !== 'paid') {
                $booking->verified_at = now();
            }
            
            $booking->payment_status = $newStatus;
            $booking->save();

            return response()->json([
                'success' => true,
                'message' => 'Status berhasil diupdate!',
                'data' => $booking
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    // REJECT BOOKING WITH REASON
    public function rejectBooking(Request $request, $id)
    {
        try {
            \Log::info('Rejecting booking ID: ' . $id);
            \Log::info('Rejection data:', $request->all());
            
            $booking = Booking::findOrFail($id);
            
            $request->validate([
                'rejection_reason' => 'required|string|max:500'
            ]);
            
            DB::beginTransaction();
            
            $oldStatus = $booking->payment_status;
            $booking->payment_status = 'rejected';
            $booking->rejection_reason = $request->rejection_reason;
            $booking->rejected_at = now();
            $booking->save();
            
            // Kembalikan kuota jika booking sebelumnya dalam status waiting_confirmation
            if ($oldStatus === 'waiting_confirmation' && $booking->booking_date) {
                $schedule = Schedule::where('schedule_date', $booking->booking_date)->first();
                if ($schedule && $schedule->filled > 0) {
                    $schedule->decrement('filled');
                    \Log::info('Quota restored for schedule: ' . $schedule->id);
                }
            }
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Booking berhasil ditolak!',
                'data' => $booking
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Reject booking error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menolak booking: ' . $e->getMessage()
            ], 500);
        }
    }

    // Cancel booking (change status to cancelled)
    public function cancelBooking($id)
    {
        try {
            $booking = Booking::findOrFail($id);
            
            DB::beginTransaction();
            
            $booking->payment_status = 'cancelled';
            $booking->save();
            
            // Kembalikan kuota
            if ($booking->booking_date) {
                $schedule = Schedule::where('schedule_date', $booking->booking_date)->first();
                if ($schedule && $schedule->filled > 0) {
                    $schedule->decrement('filled');
                }
            }
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Booking berhasil dibatalkan!',
                'data' => $booking
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    // Check booking by code
    public function checkBooking($code)
    {
        try {
            $booking = Booking::where('booking_code', $code)->first();

            if ($booking) {
                return response()->json([
                    'success' => true,
                    'data' => $booking
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Booking tidak ditemukan'
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // Update booking data
    public function update(Request $request, $id)
    {
        try {
            $booking = Booking::findOrFail($id);
            
            $request->validate([
                'customer_name' => 'nullable|string|max:100',
                'phone' => 'nullable|string|max:20',
                'package_name' => 'nullable|string',
                'booking_date' => 'nullable|date',
                'total_price' => 'nullable|numeric',
                'notes' => 'nullable|string'
            ]);
            
            $booking->update($request->only([
                'customer_name', 'phone', 'package_name', 
                'booking_date', 'total_price', 'notes'
            ]));
            
            return response()->json([
                'success' => true,
                'message' => 'Booking berhasil diupdate!',
                'data' => $booking
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    // Delete booking permanently
    public function destroy($id)
    {
        try {
            $booking = Booking::findOrFail($id);
            
            // Hapus file bukti transfer jika ada
            if ($booking->payment_proof) {
                $path = str_replace('/storage/', '', $booking->payment_proof);
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }
            
            // Kembalikan kuota sebelum hapus
            if ($booking->booking_date && in_array($booking->payment_status, ['waiting_confirmation', 'paid'])) {
                $schedule = Schedule::where('schedule_date', $booking->booking_date)->first();
                if ($schedule && $schedule->filled > 0) {
                    $schedule->decrement('filled');
                }
            }
            
            $booking->delete();

            return response()->json([
                'success' => true,
                'message' => 'Booking berhasil dihapus permanen!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}