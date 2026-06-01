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

// Halaman detail produk (menggunakan file detail.produk.blade.php)
Route::get('/tour/{id}', [TourController::class, 'detail'])->name('tour.detail');