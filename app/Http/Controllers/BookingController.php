<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Schedule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB; // TAMBAHKAN INI!

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::orderBy('created_at', 'desc')->get();
        return view('admin.booking', compact('bookings'));
    }

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

    // HAPUS method store yang lama, cukup satu method store saja
    public function store(Request $request)
    {
        try {
            \Log::info('Booking data:', $request->all());

            $request->validate([
                'nama' => 'required|string|max:100',
                'email' => 'required|email|max:100',
                'whatsapp' => 'required|string|max:20',
                'paket' => 'required|string',
                'tanggal' => 'required|date',
                'total' => 'required|integer',
                'catatan' => 'nullable|string',
                'bukti_transfer' => 'nullable|image|mimes:jpeg,jpg,png|max:2048'
            ]);

            $bookingCode = 'CYK' . date('Ymd') . rand(100, 999);

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

            // START TRANSACTION UNTUK RACE CONDITION
            DB::beginTransaction();

            // Cari schedule dengan LOCK
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
                    'message' => 'Maaf, kuota sudah penuh!'
                ], 400);
            }

            // Update kuota
            $schedule->increment('filled');

            // Simpan booking
            $booking = Booking::create([
                'booking_code' => $bookingCode,
                'package_name' => $request->paket,
                'customer_name' => $request->nama,
                'email' => $request->email,
                'phone' => $request->whatsapp,
                'participants' => 1,
                'booking_date' => $request->tanggal,
                'total_price' => $request->total,
                'dp_amount' => $request->total * 0.5,
                'remaining_amount' => $request->total * 0.5,
                'notes' => $request->catatan,
                'payment_proof' => $paymentProof,
                'payment_status' => 'waiting_confirmation'
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Booking berhasil!',
                'booking_code' => $bookingCode,
                'remaining_quota' => $schedule->quota - $schedule->filled,
                'data' => $booking
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Booking error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $booking = Booking::findOrFail($id);
            $booking->payment_status = $request->status;
            $booking->save();

            return response()->json([
                'success' => true,
                'message' => 'Status berhasil diupdate!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    // Cek booking berdasarkan kode booking
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

    public function destroy($id)
    {
        try {
            $booking = Booking::findOrFail($id);
            $booking->delete();

            return response()->json([
                'success' => true,
                'message' => 'Booking berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}