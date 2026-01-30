<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use App\Models\Student;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Helpers\NumberToWords;
use Illuminate\Support\Facades\Mail;
use App\Mail\FeeReceiptMail;

class FeeController extends Controller
{
    // =====================
    // LIST FEES
    // =====================
    public function index()
    {
        $fees = Fee::with('student.room')->get();
        return view('fees.index', compact('fees'));
    }

    // =====================
    // CREATE FEES FORM
    // =====================
    public function create()
    {
        $students = Student::all();
        return view('fees.create', compact('students'));
    }

    // =====================
    // STORE FEES + RECEIPT + MAIL
    // =====================
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'total_fees' => 'required|numeric|min:0',
            'paid_fees'  => 'required|numeric|min:0',
        ]);

        $pending = $request->total_fees - $request->paid_fees;

        // 1️⃣ Create fee
        $fee = Fee::create([
            'student_id'   => $request->student_id,
            'total_fees'   => $request->total_fees,
            'paid_fees'    => $request->paid_fees,
            'pending_fees' => $pending,
            'payment_date' => now(),
            'status'       => $pending == 0 ? 'PAID' : 'PARTIAL',
        ]);

        // 2️⃣ Generate receipt number
        $fee->receipt_no = 'REC-' . date('Y') . '-' . str_pad($fee->id, 4, '0', STR_PAD_LEFT);
        $fee->save();

        // 3️⃣ Send email with PDF
        Mail::to($fee->student->email)->send(new FeeReceiptMail($fee));

        return redirect()
            ->route('fees.index')
            ->with('success', 'Fees added & receipt emailed successfully');
    }

    // =====================
    // EDIT FEES FORM
    // =====================
    public function edit(Fee $fee)
    {
        $students = Student::all();
        return view('fees.edit', compact('fee', 'students'));
    }

    // =====================
    // UPDATE FEES
    // =====================
    public function update(Request $request, Fee $fee)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'total_fees' => 'required|numeric|min:0',
            'paid_fees'  => 'required|numeric|min:0',
        ]);

        $pending = $request->total_fees - $request->paid_fees;

        $fee->update([
            'student_id'   => $request->student_id,
            'total_fees'   => $request->total_fees,
            'paid_fees'    => $request->paid_fees,
            'pending_fees' => $pending,
            'status'       => $pending == 0 ? 'PAID' : 'PARTIAL',
        ]);

        return redirect()
            ->route('fees.index')
            ->with('success', 'Fees updated successfully');
    }

    // =====================
    // DOWNLOAD RECEIPT PDF
    // =====================
    public function receiptPdf(Fee $fee)
    {
        $fee->load('student.room');

        $amountInWords = NumberToWords::convert($fee->paid_fees);

        $pdf = Pdf::loadView('fees.receipt-pdf', compact('fee', 'amountInWords'))
                  ->setPaper('A4', 'portrait');

        // ✅ SAFE filename (NO / character)
        return $pdf->download('Fee_Receipt_'.$fee->id.'.pdf');
    }
}
