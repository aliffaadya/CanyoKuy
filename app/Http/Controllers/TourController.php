<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TourController extends Controller
{
    public function detail($id)
    {
        // Data sementara (dummy) karena model Tour mungkin belum ada
        $tour = (object) [
            'id' => $id,
            'title' => 'Paket Wisata Canyoneering',
            'subtitle' => 'Petualangan Seru',
            'description' => 'Nikmati pengalaman canyoneering yang tak terlupakan bersama guide profesional.',
            'price' => 330000,
            'duration' => 2,
            'region' => 'Tanah Bumbu',
            'max_persons' => 10,
            'category' => 'camp',
            'image_url' => '/images/camp.jpg'
        ];
        
        $relatedTours = [];
        
        return view('detail.produk', compact('tour', 'relatedTours'));
    }
}