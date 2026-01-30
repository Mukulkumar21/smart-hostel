<?php

namespace App\Http\Controllers;

use App\Models\Student;

class WardenStudentController extends Controller
{
    // LIST
    public function index()
    {
        $students = Student::with('room')->latest()->get();
        return view('warden.students.index', compact('students'));
    }

    // VIEW ONLY
    public function show(Student $student)
    {
        return view('warden.students.show', compact('student'));
    }
}