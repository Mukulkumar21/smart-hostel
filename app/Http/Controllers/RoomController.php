<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Student;
use App\Models\RoomMovement;
use Illuminate\Http\Request;
use App\Exports\RoomMovementsExport;
use Maatwebsite\Excel\Facades\Excel;

class RoomController extends Controller
{
    // =====================
    // LIST ROOMS
    // =====================
    public function index()
    {
        // Auto occupancy count
        $rooms = Room::withCount('students')->get();

        return view('rooms.index', compact('rooms'));
    }

    // =====================
    // SHOW ROOM + IN / OUT
    // =====================
    public function show(Room $room)
    {
        // Load students of this room
        $room->load('students');

        // Students not assigned to any room (for IN)
        $availableStudents = Student::whereNull('room_id')->get();

        return view('rooms.show', compact('room', 'availableStudents'));
    }

    // =====================
    // CREATE ROOM FORM
    // =====================
    public function create()
    {
        return view('rooms.create');
    }

    // =====================
    // STORE ROOM
    // =====================
    public function store(Request $request)
    {
        $request->validate([
            'room_number' => 'required|unique:rooms,room_number',
            'capacity'    => 'required|integer|min:1',
        ]);

        Room::create([
            'room_number' => $request->room_number,
            'capacity'    => $request->capacity,
            'status'      => 'OPEN', // default
        ]);

        return redirect()
            ->route('rooms.index')
            ->with('success', 'Room added successfully');
    }

    // =====================
    // ROOM-WISE MOVEMENT REPORT (IN / OUT)
    // =====================
    public function movements(Room $room)
    {
        $room->load('students');

        $movements = RoomMovement::with('student')
            ->where('room_id', $room->id)
            ->orderByDesc('moved_at')
            ->get();

        return view('rooms.movements', compact('room', 'movements'));
    }

    // =====================
    // EXPORT MOVEMENTS (EXCEL)
    // =====================
    public function exportExcel(Room $room)
    {
        return Excel::download(
            new RoomMovementsExport($room->id),
            'room_'.$room->room_number.'_movements.xlsx'
        );
    }
}
