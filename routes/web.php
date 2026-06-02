<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TourController;
use App\Models\Tour;


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

// Halaman booking (langsung view, tanpa controller)
Route::get('/booking', function () {
    return view('booking');
})->name('booking');

// Admin page (pakai closure juga, tanpa controller)
Route::get('/admin/bookings', function () {
    return view('admin.bookings');
})->name('admin.bookings');

// Halaman detail produk (menggunakan file detail.produk.blade.php)
Route::get('/tour/{id}', [TourController::class, 'detail'])->name('tour.detail');