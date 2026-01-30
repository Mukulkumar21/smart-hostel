<?php

namespace App\Http\Controllers\Warden;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Room;
use App\Models\RoomMovement;
use Carbon\Carbon;

class WardenDashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        /* ================= BASIC COUNTS ================= */
        $totalStudents = Student::count();
        $totalRooms    = Room::count();

        $occupiedRooms = Student::whereNotNull('room_id')
            ->distinct('room_id')
            ->count('room_id');

        $availableRooms = $totalRooms - $occupiedRooms;

        /* ================= TODAY IN / OUT ================= */
        $todayIn = RoomMovement::whereDate('moved_at', $today)
            ->where('movement_type', 'IN')
            ->count();

        $todayOut = RoomMovement::whereDate('moved_at', $today)
            ->where('movement_type', 'OUT')
            ->count();

        /* ================= CURRENT STATUS ================= */
        $studentsOut = Student::all()
            ->filter(fn ($s) => $s->isCurrentlyOut())
            ->count();

        $currentlyOut = $studentsOut;
        $currentlyIn  = $totalStudents - $studentsOut;

        /* ================= LAST 7 DAYS DATA ================= */
        $days = [];
        $weeklyIn  = [];
        $weeklyOut = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);

            $days[] = $date->format('d M');

            $weeklyIn[] = RoomMovement::whereDate('moved_at', $date)
                ->where('movement_type', 'IN')
                ->count();

            $weeklyOut[] = RoomMovement::whereDate('moved_at', $date)
                ->where('movement_type', 'OUT')
                ->count();
        }

        /* ================= RECENT MOVEMENTS ================= */
        $recentMovements = RoomMovement::with('student')
            ->latest('moved_at')
            ->limit(10)
            ->get();

       return view('warden.dashboard', compact(
    'totalStudents',
    'totalRooms',
    'occupiedRooms',
    'availableRooms',
    'todayIn',
    'todayOut',
    'studentsOut',
    'currentlyIn',
    'currentlyOut',
    'recentMovements',
    'days',
    'weeklyIn',
    'weeklyOut'
));
    }
}