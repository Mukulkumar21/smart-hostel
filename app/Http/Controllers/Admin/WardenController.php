<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Warden;
use App\Mail\WardenWelcomeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class WardenController extends Controller
{
    // 🔹 LIST
    public function index()
    {
        $wardens = Warden::latest()->get();
        return view('admin.wardens.index', compact('wardens'));
    }

    // 🔹 CREATE FORM
    public function create()
    {
        return view('admin.wardens.create');
    }

    // 🔹 STORE (AUTO PASSWORD + EMAIL)
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:wardens,email',
        ]);

        // 🔐 Auto-generate password
        $plainPassword = Str::random(8);

        // ✅ Create warden
        $warden = Warden::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($plainPassword),
            'status'   => 'active',
        ]);

        // 📧 Send welcome email (QUEUE)
        Mail::to($warden->email)->send(
            new WardenWelcomeMail($warden, $plainPassword)
        );

        return redirect()
            ->route('admin.wardens.index')
            ->with('success', 'Warden created & credentials emailed successfully');
    }
}