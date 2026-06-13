<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TourController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\BookingController;
use Illuminate\Http\Request;

// ========== HALAMAN DEPAN ==========
Route::get('/', function () {
    return view('beranda');
})->name('beranda');

Route::get('/guide', function () {
    return view('guide');
})->name('guide');

Route::get('/cekBooking', function () {
    return view('cekBooking');
})->name('cekBooking');

Route::get('/detailCamp', function () {
    return view('detailCamp');
})->name('detailCamp');

Route::get('/detailRoundTrip', function () {
    return view('detailRoundTrip');
})->name('detailRoundTrip');

// ========== HALAMAN BOOKING ==========
Route::get('/booking/camp', function () {
    return view('booking-camp');
})->name('booking.camp');

Route::get('/booking/roundtrip', function () {
    return view('booking-roundtrip');
})->name('booking.roundtrip');

Route::get('/tour/{id}', [TourController::class, 'detail'])->name('tour.detail');

// ========== API ROUTES ==========
Route::prefix('api')->group(function () {
    // API Testimoni
    Route::get('/testimonials', [TestimonialController::class, 'getActiveTestimonials']);
    Route::post('/testimonials', [TestimonialController::class, 'store']);
    Route::put('/testimonials/{id}', [TestimonialController::class, 'update']);
    Route::delete('/testimonials/{id}', [TestimonialController::class, 'destroy']);
    
    // API Guide
    Route::get('/guides', [GuideController::class, 'getActiveGuides']);
    Route::post('/guides', [GuideController::class, 'store']);
    Route::put('/guides/{id}', [GuideController::class, 'update']);
    Route::delete('/guides/{id}', [GuideController::class, 'destroy']);
    
    // API Schedule
    Route::get('/schedules', [ScheduleController::class, 'getActiveSchedules']);
    Route::post('/schedules', [ScheduleController::class, 'store']);
    Route::put('/schedules/{id}', [ScheduleController::class, 'update']);
    Route::delete('/schedules/{id}', [ScheduleController::class, 'destroy']);
    
    // API Booking
    Route::get('/bookings', [BookingController::class, 'getAllBookings']);
    Route::post('/bookings', [BookingController::class, 'store']);
    Route::put('/bookings/{id}/status', [BookingController::class, 'updateStatus']);
    Route::delete('/bookings/{id}', [BookingController::class, 'destroy']);
    
    // API CEK BOOKING (TAMBAHKAN INI)
    Route::get('/bookings/check/{code}', [BookingController::class, 'checkBooking']);
});

// ========== HALAMAN ADMIN ==========
Route::prefix('admin')->group(function () {

    Route::get('/login', function () {
        if (session()->has('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    })->name('admin.login');

    Route::post('/login', function (Request $request) {
        $username = $request->username;
        $password = $request->password;

        if ($username === 'admin' && $password === 'admin123') {
            session(['admin_logged_in' => true]);
            session(['admin_username' => $username]);
            return redirect()->route('admin.dashboard');
        } else {
            return back()->with('error', '❌ Username atau password salah!');
        }
    })->name('admin.login.post');

    Route::get('/logout', function () {
        session()->forget('admin_logged_in');
        session()->forget('admin_username');
        return redirect()->route('admin.login')->with('success', 'Berhasil logout!');
    })->name('admin.logout');

    Route::get('/dashboard', function () {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login')->with('error', 'Silakan login terlebih dahulu!');
        }
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // HALAMAN ADMIN BOOKING
    Route::get('/booking', [BookingController::class, 'index'])->name('admin.booking');

    // HALAMAN ADMIN JADWAL
    Route::get('/jadwal', [ScheduleController::class, 'index'])->name('admin.jadwal');

    // HALAMAN ADMIN GUIDE
    Route::get('/guide', [GuideController::class, 'index'])->name('admin.guide');

    // HALAMAN ADMIN TESTIMONI
    Route::get('/testimoni', [TestimonialController::class, 'index'])->name('admin.testimoni');
});