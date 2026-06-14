<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TourController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\PackageGalleryController;

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

// ========== API ROUTES (untuk AJAX) ==========
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

    // API Booking LENGKAP
    Route::get('/bookings', [BookingController::class, 'getAllBookings']);
    Route::get('/bookings/stats', [BookingController::class, 'getStats']);
    Route::get('/bookings/{id}', [BookingController::class, 'getBooking']);
    Route::get('/bookings/check/{code}', [BookingController::class, 'checkBooking']);
    Route::post('/bookings', [BookingController::class, 'store']);
    Route::put('/bookings/{id}/status', [BookingController::class, 'updateStatus']);
    Route::post('/bookings/{id}/reject', [BookingController::class, 'rejectBooking']);
    Route::delete('/bookings/{id}', [BookingController::class, 'destroy']);
});

// ========== HALAMAN ADMIN ==========
Route::prefix('admin')->group(function () {
    // Login & Logout
    Route::get('/login', [AdminController::class, 'loginForm'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login.post');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');

    // Dashboard (perbaiki ini)
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Data Booking
    Route::get('/booking', [BookingController::class, 'index'])->name('admin.booking');

    // Kelola Jadwal
    Route::get('/jadwal', [ScheduleController::class, 'index'])->name('admin.jadwal');

    // Kelola Tour Guide
    Route::get('/guide', [GuideController::class, 'index'])->name('admin.guide');

    // Kelola Testimoni
    Route::get('/testimoni', [TestimonialController::class, 'index'])->name('admin.testimoni');

    // Galeri Paket
    Route::get('/package-gallery', function () {
        return view('admin.package-gallery');
    })->name('admin.package-gallery');

    // Profile & Ganti Password
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::put('/profile', [AdminController::class, 'updateProfile'])->name('admin.update-profile');
    Route::post('/change-password', [AdminController::class, 'changePassword'])->name('admin.change-password');

    // Lupa Password
    Route::get('/forgot-password', [AdminController::class, 'forgotPasswordForm'])->name('admin.forgot-password');
    Route::post('/forgot-password', [AdminController::class, 'sendResetLink'])->name('admin.forgot-password.post');
    Route::get('/reset-password/{token}', [AdminController::class, 'resetPasswordForm'])->name('admin.reset-password.form');
    Route::post('/reset-password', [AdminController::class, 'resetPassword'])->name('admin.reset-password.post');
});