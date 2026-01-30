<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WardenAuthController extends Controller
{
    // =========================
    // SHOW LOGIN FORM
    // =========================
    public function showLogin()
    {
        return view('warden.auth.login');
    }

    // =========================
    // LOGIN
    // =========================
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('warden')->attempt($credentials)) {
            $request->session()->regenerate();

            // ✅ SUCCESS → DASHBOARD
            return redirect()->route('warden.dashboard');
        }

        // ❌ FAIL
        return back()->withErrors([
            'email' => 'Invalid email or password',
        ]);
    }

    // =========================
    // LOGOUT
    // =========================
    public function logout(Request $request)
    {
        Auth::guard('warden')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('warden.login');
    }
}