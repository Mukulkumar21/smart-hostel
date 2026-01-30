<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Room;
use App\Models\RoomChangeHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\StudentAccountCreatedMail;

class StudentController extends Controller
{
    // =====================
    // LIST STUDENTS (ADMIN)
    // =====================
    public function index()
    {
        $students = Student::with('room')
            ->latest()
            ->paginate(10);

        return view('students.index', compact('students'));
    }

    // =====================
    // CREATE FORM (ADMIN)
    // =====================
    public function create()
    {
        $rooms = Room::withCount('students')->get();
        return view('students.create', compact('rooms'));
    }

    // =====================
    // STORE STUDENT (ADMIN)
    // =====================
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:students,email',
            'room_id' => 'nullable|exists:rooms,id',
        ]);

        // 🔐 Auto-generate password
        $plainPassword = Str::random(8);

        $student = Student::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'room_id'  => $data['room_id'] ?? null,
            'password' => Hash::make($plainPassword),
        ]);

        // 📧 Send credentials email
        Mail::to($student->email)
            ->send(new StudentAccountCreatedMail($student, $plainPassword));

        return redirect()
            ->route('students.index')
            ->with('success', 'Student created & login credentials emailed');
    }

    // =====================
    // SHOW STUDENT
    // =====================
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    // =====================
    // EDIT FORM (ADMIN)
    // =====================
    public function edit(Student $student)
    {
        $rooms = Room::withCount('students')->get();
        return view('students.edit', compact('student', 'rooms'));
    }

    // =====================
    // UPDATE STUDENT (ADMIN)
    // =====================
    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:students,email,' . $student->id,
            'room_id' => 'nullable|exists:rooms,id',
        ]);

        $oldRoom = $student->room_id;

        $student->update($data);

        // 🕒 Track room change
        if ($oldRoom != $data['room_id']) {
            RoomChangeHistory::create([
                'student_id'  => $student->id,
                'old_room_id' => $oldRoom,
                'new_room_id' => $data['room_id'],
                'changed_at'  => now(),
            ]);
        }

        return redirect()
            ->route('students.index')
            ->with('success', 'Student updated successfully');
    }

    // =====================
    // DELETE STUDENT
    // =====================
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()
            ->route('students.index')
            ->with('success', 'Student deleted successfully');
    }

    // =====================
    // ROOM HISTORY (ADMIN)
    // =====================
    public function roomHistory(Student $student)
    {
        $histories = RoomChangeHistory::with(['oldRoom', 'newRoom'])
            ->where('student_id', $student->id)
            ->orderBy('changed_at', 'desc')
            ->get();

        return view('students.room-history', compact('student', 'histories'));
    }

    // ======================================================
    // ================= WARDEN SECTION =====================
    // ======================================================

    // LIST (WARDEN)
    public function wardenIndex()
    {
        $students = Student::with('room')->latest()->get();
        return view('warden.students.index', compact('students'));
    }

    // EDIT (WARDEN)
    public function wardenEdit(Student $student)
    {
        $rooms = Room::all();
        return view('warden.students.edit', compact('student', 'rooms'));
    }

    // UPDATE (WARDEN)
    public function wardenUpdate(Request $request, Student $student)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'room_id' => 'nullable|exists:rooms,id',
        ]);

        $student->update($data);

        return redirect()
            ->route('warden.students.index')
            ->with('success', 'Student updated successfully');
    }
}