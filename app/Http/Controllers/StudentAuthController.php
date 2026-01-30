<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WardenAuthController extends Controller
{
    /**
     * SHOW WARDEN LOGIN PAGE
     */
    public function showLogin()
    {
        return view('warden.auth.login');
    }

    /**
     * HANDLE WARDEN LOGIN
     */
    public function login(Request $request)
    {
        // ✅ Validate input
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // ✅ Logout other guards (NO session invalidate here)
        Auth::guard('web')->logout();
        Auth::guard('student')->logout();

        // ✅ Attempt login
        if (Auth::guard('warden')->attempt($credentials)) {
            // 🔥 fixes 419
            $request->session()->regenerate();

            return redirect()->route('warden.dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid warden credentials',
        ])->withInput($request->only('email'));
    }

    /**
     * LOGOUT WARDEN
     */
    public function logout(Request $request)
    {
        Auth::guard('warden')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('warden.login');
    }
}
