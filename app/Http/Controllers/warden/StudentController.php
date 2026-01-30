<?php

namespace App\Http\Controllers\Warden;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Room;
use App\Models\RoomMovement;
use App\Mail\StudentWelcomeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Exports\StudentsExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
class StudentController extends Controller
{
    // ================= LIST STUDENTS =================
  public function index(Request $request)
{
    $query = Student::with('room');

    // 🔍 Search by name or email
    if ($request->filled('search')) {
        $query->where(function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('email', 'like', '%' . $request->search . '%');
        });
    }

    // 🏠 Filter by room
    if ($request->filled('room_id')) {
        $query->where('room_id', $request->room_id);
    }

    // 🚦 Filter by status
    if ($request->filled('status')) {
        if ($request->status === 'out') {
            $query->whereHas('movements', function ($q) {
                $q->latest('moved_at')->where('movement_type', 'OUT');
            });
        }

        if ($request->status === 'in') {
            $query->whereDoesntHave('movements', function ($q) {
                $q->latest('moved_at')->where('movement_type', 'OUT');
            });
        }
    }

    $students = $query->latest()->get();
    $rooms = Room::all();

    return view('warden.students.index', compact('students', 'rooms'));
}
    // ================= CREATE FORM =================
    public function create()
    {
        $rooms = Room::all();
        return view('warden.students.create', compact('rooms'));
    }

    // ================= STORE STUDENT =================
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:students,email',
            'phone'   => 'nullable|string|max:20',
            'gender'  => 'nullable|string',
            'room_id' => 'nullable|exists:rooms,id',
            'photo'   => 'nullable|image|max:2048',
        ]);

        $plainPassword = Str::random(8);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('students', 'public');
        }

        $student = Student::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'gender'   => $request->gender,
            'room_id'  => $request->room_id,
            'photo'    => $photoPath,
            'password' => Hash::make($plainPassword),
        ]);

        Mail::to($student->email)->send(
            new StudentWelcomeMail($student, $plainPassword)
        );

        return redirect()
            ->route('warden.students.index')
            ->with('success', 'Student created & login details emailed successfully');
    }

    // ================= SHOW STUDENT =================
    public function show(Student $student)
    {
        $student->load('room');
        return view('warden.students.show', compact('student'));
    }

    // ================= MOVEMENT HISTORY (🔥 FIXED) =================
    public function history(Student $student)
    {
        $movements = RoomMovement::with('room')
            ->where('student_id', $student->id)
            ->orderBy('moved_at', 'desc')
            ->get();

        return view('warden.students.history', compact('student', 'movements'));
    }
    // ================= EDIT FORM =================
public function edit(Student $student)
{
    $rooms = Room::all();
    return view('warden.students.edit', compact('student', 'rooms'));
}

// ================= UPDATE STUDENT =================
public function update(Request $request, Student $student)
{
    $request->validate([
        'name'    => 'required|string|max:255',
        'email'   => 'required|email|unique:students,email,' . $student->id,
        'phone'   => 'nullable|string|max:20',
        'gender'  => 'nullable|string',
        'room_id' => 'nullable|exists:rooms,id',
        'photo'   => 'nullable|image|max:2048',
    ]);

    // Photo update
    if ($request->hasFile('photo')) {
        $student->photo = $request->file('photo')->store('students', 'public');
    }

    $student->update([
        'name'    => $request->name,
        'email'   => $request->email,
        'phone'   => $request->phone,
        'gender'  => $request->gender,
        'room_id' => $request->room_id,
    ]);

    return redirect()
        ->route('warden.students.show', $student)
        ->with('success', 'Student profile updated successfully');
}
// ================= EXPORT PDF =================
public function exportPdf()
{
    $students = Student::with('room')->get();

    $pdf = Pdf::loadView('warden.students.export-pdf', compact('students'));

    return $pdf->download('students-list.pdf');
}

// ================= EXPORT EXCEL =================
public function exportExcel()
{
    return Excel::download(new StudentsExport, 'students-list.xlsx');
}
}