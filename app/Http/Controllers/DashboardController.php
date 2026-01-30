<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Room;
use App\Models\Fee;            // ✅ REQUIRED
use App\Models\RoomMovement;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // =====================
        // BASIC STATS
        // =====================
        $totalStudents = Student::count();
        $totalRooms    = Room::count();
        $occupiedRooms = Room::has('students')->count();

        // =====================
        // FEES SUMMARY
        // =====================
        $totalFeesCollected = Fee::sum('paid_fees');
        $totalPendingFees   = Fee::sum('pending_fees');

        // =====================
        // ROOM OCCUPANCY
        // =====================
        $roomMovements = Room::withCount('students')->get();

        // =====================
        // MOVEMENT CHART DATA (IN / OUT)
        // =====================
        $movementData = RoomMovement::select(
                DB::raw('DATE(moved_at) as date'),
                DB::raw("SUM(CASE WHEN movement_type = 'IN' THEN 1 ELSE 0 END) as in_count"),
                DB::raw("SUM(CASE WHEN movement_type = 'OUT' THEN 1 ELSE 0 END) as out_count")
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('dashboard.index', compact(
            'totalStudents',
            'totalRooms',
            'occupiedRooms',
            'totalFeesCollected',
            'totalPendingFees',
            'roomMovements',
            'movementData'
        ));
    }
}
