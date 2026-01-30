<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\RoomMovement;
use Illuminate\Http\Request;

class RoomMovementController extends Controller
{
    /**
     * ============================
     * WARDEN: Student IN
     * ============================
     * Sirf movement record karega
     * room_id change nahi karega
     */
    public function in(Student $student)
    {
        // Already IN? to kuch mat karo
        if ($student->isCurrentlyIn()) {
            return back()->with('error', 'Student is already IN');
        }

        RoomMovement::create([
            'student_id'    => $student->id,
            'movement_type' => 'IN',
            'moved_at'      => now(),
            'reason'        => 'Student entered hostel',
        ]);

        return back()->with('success', 'Student marked IN successfully');
    }

    /**
     * ============================
     * WARDEN: Student OUT
     * ============================
     */
    public function out(Student $student)
    {
        // Already OUT? to kuch mat karo
        if ($student->isCurrentlyOut()) {
            return back()->with('error', 'Student is already OUT');
        }

        RoomMovement::create([
            'student_id'    => $student->id,
            'movement_type' => 'OUT',
            'moved_at'      => now(),
            'reason'        => 'Student exited hostel',
        ]);

        return back()->with('success', 'Student marked OUT successfully');
    }
}
