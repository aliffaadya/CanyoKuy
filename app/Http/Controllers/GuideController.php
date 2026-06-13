<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guide;

class GuideController extends Controller
{
    public function index()
    {
        $guides = Guide::orderBy('created_at', 'desc')->get();
        return view('admin.guide', compact('guides'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:100',
                'skill' => 'required|string|max:100',
            ]);

            $guide = Guide::create([
                'name' => $request->name,
                'skill' => $request->skill,
                'image' => $request->image ?? '/images/default-avatar.jpg',
                'is_active' => true
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Guide berhasil ditambahkan!',
                'data' => $guide
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:100',
                'skill' => 'required|string|max:100',
            ]);

            $guide = Guide::findOrFail($id);
            $guide->update([
                'name' => $request->name,
                'skill' => $request->skill,
                'image' => $request->image ?? $guide->image
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Guide berhasil diupdate!',
                'data' => $guide
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
            $guide = Guide::findOrFail($id);
            $guide->delete();

            return response()->json([
                'success' => true,
                'message' => 'Guide berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getActiveGuides()
    {
        try {
            $guides = Guide::where('is_active', true)
                ->orderBy('created_at', 'desc')
                ->get();
            
            return response()->json([
                'success' => true,
                'data' => $guides
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}