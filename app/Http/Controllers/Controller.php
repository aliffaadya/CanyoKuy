<?php

namespace App\Http\Controllers;

class TourController extends Controller
{
    // Halaman detail produk
    public function detail($id)
    {
        $tour = Tour::findOrFail($id);
        $relatedTours = Tour::where('id', '!=', $id)->limit(3)->get();
        
        return view('detail.produk', compact('tour', 'relatedTours'));
    }
}