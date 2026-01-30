<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\RoomMovement;
use App\Models\Fee;
use App\Models\GatePass;

class StudentDashboardController extends Controller
{
    // =========================
    // STUDENT DASHBOARD
    // =========================
    public function index()
    {
        $student = Auth::guard('student')->user();

        // Fees
        $fees = $student->fees ?? [];

        // Latest IN / OUT movement
        $lastMovement = RoomMovement::where('student_id', $student->id)
            ->latest()
            ->first();

        $currentStatus = $lastMovement ? $lastMovement->movement_type : 'IN';

        // ✅ LATEST GATE PASS (FIX)
        $latestGatePass = GatePass::where('student_id', $student->id)
            ->latest()
            ->first();

        return view('student.dashboard', compact(
            'student',
            'fees',
            'currentStatus',
            'latestGatePass' // ✅ VERY IMPORTANT
        ));
    }

    // =========================
    // STUDENT PROFILE
    // =========================
    public function profile()
    {
        $student = Auth::guard('student')->user();

        $lastMovement = RoomMovement::where('student_id', $student->id)
            ->latest()
            ->first();

        $currentStatus = $lastMovement ? $lastMovement->movement_type : 'IN';

        return view('student.profile', compact(
            'student',
            'currentStatus'
        ));
    }

    // =========================
    // STUDENT MOVEMENT HISTORY
    // =========================
    public function movements()
    {
        $student = Auth::guard('student')->user();

        $movements = RoomMovement::where('student_id', $student->id)
            ->latest()
            ->get();

        return view('student.movements', compact('movements'));
    }

    // =========================
    // STUDENT FEE RECEIPT (SECURE)
    // =========================
    public function feeReceipt(Fee $fee)
    {
        $student = Auth::guard('student')->user();

        if ($fee->student_id !== $student->id) {
            abort(Response::HTTP_FORBIDDEN, 'Unauthorized access');
        }

        if (!$fee->receipt_path) {
            abort(404, 'Receipt not found');
        }

        return response()->file(
            storage_path('app/public/' . $fee->receipt_path)
        );
    }

    // =========================
    // GATE PASS REQUEST FORM
    // =========================
    public function gatePassForm()
    {
        return view('student.gate-pass');
    }

    // =========================
    // STORE GATE PASS REQUEST
    // =========================
    public function submitGatePass(Request $request)
    {
        $request->validate([
            'reason'    => 'required|string',
            'from_time' => 'required|date',
            'to_time'   => 'required|date|after:from_time',
        ]);

        GatePass::create([
            'student_id' => Auth::guard('student')->id(),
            'reason'     => $request->reason,
            'from_time'  => $request->from_time,
            'to_time'    => $request->to_time,
        ]);

        return redirect()
            ->route('student.dashboard')
            ->with('success', 'Gate Pass request sent to Warden');
    }
}