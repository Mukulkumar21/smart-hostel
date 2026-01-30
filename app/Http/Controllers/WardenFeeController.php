<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Fee;

class WardenFeeController extends Controller
{
    /**
     * All students fee overview
     */
    public function index()
    {
        $students = Student::with('fees')->get();

        return view('warden.fees.index', compact('students'));
    }

    /**
     * Single student fee details
     */
    public function show(Student $student)
    {
        $fees = $student->fees;

        return view('warden.fees.show', compact('student', 'fees'));
    }

    /**
     * Download receipt PDF
     */
    public function receipt(Fee $fee)
    {
        if (!$fee->receipt_path || !file_exists(storage_path('app/' . $fee->receipt_path))) {
            abort(404, 'Receipt not found');
        }

        return response()->file(storage_path('app/' . $fee->receipt_path));
    }
}