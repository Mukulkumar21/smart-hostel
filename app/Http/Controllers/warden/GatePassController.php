<?php

namespace App\Http\Controllers\Warden;

use App\Http\Controllers\Controller;
use App\Models\GatePass;
use Illuminate\Support\Facades\Auth;

class GatePassController extends Controller
{
    /**
     * =========================
     * LIST ALL GATE PASS REQUESTS
     * =========================
     */
    public function index()
    {
        // Saare gate pass requests + student data
        $gatePasses = GatePass::with('student')
            ->latest()
            ->get();

        return view('warden.gate-passes.index', compact('gatePasses'));
    }

    /**
     * =========================
     * APPROVE GATE PASS
     * =========================
     */
    public function approve(GatePass $gatePass)
    {
        // Agar already processed hai to dubara na ho
        if ($gatePass->status !== 'PENDING') {
            return back()->with('error', 'This request is already processed');
        }

        $gatePass->update([
            'status'       => 'APPROVED',
            'approved_by'  => Auth::guard('warden')->id(),
        ]);

        return back()->with('success', 'Gate Pass approved successfully');
    }

    /**
     * =========================
     * REJECT GATE PASS
     * =========================
     */
    public function reject(GatePass $gatePass)
    {
        if ($gatePass->status !== 'PENDING') {
            return back()->with('error', 'This request is already processed');
        }

        $gatePass->update([
            'status'       => 'REJECTED',
            'approved_by'  => Auth::guard('warden')->id(),
        ]);

        return back()->with('success', 'Gate Pass rejected successfully');
    }
}