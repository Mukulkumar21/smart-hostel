<?php

namespace App\Http\Controllers\Warden;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\RoomMovement;
use Illuminate\Http\Request;

class RoomMovementController extends Controller
{
    public function out(Student $student)
    {
        RoomMovement::create([
            'student_id'    => $student->id,
            'room_id'       => $student->room_id,
            'movement_type' => 'OUT',
            'moved_at'      => now(),
        ]);

        return back()->with('success', 'Student marked OUT');
    }

    public function in(Student $student)
    {
        RoomMovement::create([
            'student_id'    => $student->id,
            'room_id'       => $student->room_id,
            'movement_type' => 'IN',
            'moved_at'      => Carbon::now(),
        ]);

        return back()->with('success', 'Student marked IN');
    }
}