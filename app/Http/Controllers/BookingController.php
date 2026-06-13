<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Schedule;

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

            // Generate kode booking
            $bookingCode = 'CYK' . date('Ymd') . rand(100, 999);

            // Upload bukti transfer
            $paymentProof = null;
            if ($request->hasFile('bukti_transfer')) {
                $file = $request->file('bukti_transfer');
                $filename = time() . '_' . $bookingCode . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('payment_proofs', $filename, 'public');
                $paymentProof = '/storage/' . $path;
            }

            // Cek dan update kuota schedule
            $schedule = Schedule::where('schedule_date', $request->tanggal)
                ->where('package_type', strtolower($request->paket) == 'paket camp' ? 'camp' : 'roundtrip')
                ->first();
            
            if ($schedule) {
                // Update filled + 1
                $schedule->increment('filled');
            } else {
                // Buat schedule baru jika belum ada
                $schedule = Schedule::create([
                    'schedule_date' => $request->tanggal,
                    'package_type' => strtolower($request->paket) == 'paket camp' ? 'camp' : 'roundtrip',
                    'quota' => 20,
                    'filled' => 1,
                    'is_active' => true
                ]);
            }

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

            return response()->json([
                'success' => true,
                'message' => 'Booking berhasil!',
                'booking_code' => $bookingCode,
                'remaining_quota' => $schedule->quota - $schedule->filled,
                'data' => $booking
            ]);

        } catch (\Exception $e) {
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