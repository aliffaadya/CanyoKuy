<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    // Menampilkan semua testimoni untuk admin
    public function index()
    {
        $testimonials = Testimonial::orderBy('created_at', 'desc')->get();
        return view('admin.testimoni', compact('testimonials'));
    }

    // Menyimpan testimoni baru
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:100',
                'city' => 'required|string|max:100',
                'message' => 'required|string',
                'rating' => 'required|integer|min:1|max:5'
            ]);

            $testimonial = Testimonial::create([
                'name' => $request->name,
                'city' => $request->city,
                'message' => $request->message,
                'rating' => $request->rating,
                'is_active' => true
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Testimoni berhasil ditambahkan!',
                'data' => $testimonial
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    // Update testimoni
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:100',
                'city' => 'required|string|max:100',
                'message' => 'required|string',
                'rating' => 'required|integer|min:1|max:5'
            ]);

            $testimonial = Testimonial::findOrFail($id);
            $testimonial->update([
                'name' => $request->name,
                'city' => $request->city,
                'message' => $request->message,
                'rating' => $request->rating
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Testimoni berhasil diupdate!',
                'data' => $testimonial
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    // Hapus testimoni
    public function destroy($id)
    {
        try {
            $testimonial = Testimonial::findOrFail($id);
            $testimonial->delete();

            return response()->json([
                'success' => true,
                'message' => 'Testimoni berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    // API untuk mengambil semua testimoni (untuk halaman beranda)
    public function getActiveTestimonials()
    {
        try {
            $testimonials = Testimonial::where('is_active', true)
                ->orderBy('created_at', 'desc')
                ->get();
            
            return response()->json([
                'success' => true,
                'data' => $testimonials
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}