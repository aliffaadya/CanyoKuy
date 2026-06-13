<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::orderBy('schedule_date', 'asc')->get();
        return view('admin.jadwal', compact('schedules'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'schedule_date' => 'required|date',
                'quota' => 'required|integer|min:1'
            ]);

            $schedule = Schedule::create([
                'schedule_date' => $request->schedule_date,
                'quota' => $request->quota,
                'filled' => 0,
                'is_active' => true
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Jadwal berhasil ditambahkan!',
                'data' => $schedule
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
                'schedule_date' => 'required|date',
                'quota' => 'required|integer|min:1'
            ]);

            $schedule = Schedule::findOrFail($id);
            $schedule->update([
                'schedule_date' => $request->schedule_date,
                'quota' => $request->quota
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Jadwal berhasil diupdate!',
                'data' => $schedule
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
            $schedule = Schedule::findOrFail($id);
            $schedule->delete();

            return response()->json([
                'success' => true,
                'message' => 'Jadwal berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getActiveSchedules()
{
    try {
        $schedules = Schedule::where('is_active', true)
            ->where('schedule_date', '>=', now())
            ->orderBy('schedule_date', 'asc')
            ->get();
        
        return response()->json([
            'success' => true,
            'data' => $schedules
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}
}