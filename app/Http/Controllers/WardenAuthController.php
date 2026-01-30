<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WardenAuthController extends Controller
{
    /**
     * =========================
     * SHOW WARDEN LOGIN FORM
     * =========================
     */
    public function showLogin()
    {
        // ✅ CORRECT VIEW PATH
        return view('warden.auth.login');
    }

    /**
     * =========================
     * HANDLE WARDEN LOGIN
     * =========================
     */
    public function login(Request $request)
    {
        // ✅ Validate input
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // ✅ Logout other guards only
        Auth::guard('web')->logout();
        Auth::guard('student')->logout();

        // ✅ Attempt warden login
        if (Auth::guard('warden')->attempt($credentials)) {

            // 🔥 Fixes 419 Page Expired
            $request->session()->regenerate();

            return redirect()->route('warden.dashboard');
        }

        // ❌ Login failed
        return back()->withErrors([
            'email' => 'Invalid warden credentials',
        ])->withInput($request->only('email'));
    }

    /**
     * =========================
     * LOGOUT WARDEN
     * =========================
     */
    public function logout(Request $request)
    {
        Auth::guard('warden')->logout();

        // ✅ Safe cleanup
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('warden.login');
    }
}
