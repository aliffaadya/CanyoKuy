<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TourController;
use App\Models\Tour;
use Illuminate\Http\Request;  // ← TAMBAHKAN INI!


Route::get('/', function () {
    return view('beranda');
});

/* Halaman Guide */

Route::get('/guide', function () {
    return view('guide');
});

Route::get('/cekBooking', function () {
    return view('cekBooking');
})->name('cekBooking');

Route::get('/detailCamp', function () {
    return view('detailCamp');
})->name('detailCamp');

Route::get('/detailRoundTrip', function () {
    return view('detailRoundTrip');
})->name('detailRoundTrip');

// ========== HALAMAN BOOKING (PISAH) ==========
// Booking untuk Paket Camp
Route::get('/booking/camp', function () {
    return view('booking-camp');
})->name('booking.camp');

// Booking untuk Paket Round Trip
Route::get('/booking/roundtrip', function () {
    return view('booking-roundtrip');
})->name('booking.roundtrip');

// Halaman detail produk (menggunakan file detail.produk.blade.php)
Route::get('/tour/{id}', [TourController::class, 'detail'])->name('tour.detail');

// ========== HALAMAN ADMIN ==========
Route::prefix('admin')->group(function () {
    // Halaman login (GET)
    Route::get('/login', function () {
        // Jika sudah login, redirect ke dashboard
        if (session()->has('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    })->name('admin.login');
    
    // Proses login (POST) - sudah pakai Request yang di-import
    Route::post('/login', function (Request $request) {
        $username = $request->username;
        $password = $request->password;
        
        // Cek credentials (sementara pake hardcode)
        if ($username === 'admin' && $password === 'admin123') {
            session(['admin_logged_in' => true]);
            session(['admin_username' => $username]);
            return redirect()->route('admin.dashboard');
        } else {
            return back()->with('error', '❌ Username atau password salah!');
        }
    })->name('admin.login.post');
    
    // Logout
    Route::get('/logout', function () {
        session()->forget('admin_logged_in');
        session()->forget('admin_username');
        return redirect()->route('admin.login')->with('success', '✅ Berhasil logout!');
    })->name('admin.logout');
    
    // Dashboard
    Route::get('/dashboard', function () {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login')->with('error', 'Silakan login terlebih dahulu!');
        }
        return view('admin.dashboard');
    })->name('admin.dashboard');
    
    // Data Booking
    Route::get('/booking', function () {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login')->with('error', 'Silakan login terlebih dahulu!');
        }
        return view('admin.booking');
    })->name('admin.booking');
    
    // Jadwal Kegiatan
    Route::get('/jadwal', function () {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login')->with('error', 'Silakan login terlebih dahulu!');
        }
        return view('admin.jadwal');
    })->name('admin.jadwal');
});