@extends('layouts.guest')

@section('content')
<h1 class="text-xl font-bold mb-4">Student Register</h1>

<form method="POST" action="{{ route('student.register.submit') }}">
    @csrf

    <input name="name" placeholder="Name" class="border p-2 w-full mb-2" required>

    <input name="email" type="email" placeholder="Email" class="border p-2 w-full mb-2" required>

    <input name="password" type="password" placeholder="Password" class="border p-2 w-full mb-2" required>

    <input name="password_confirmation" type="password"
           placeholder="Confirm Password"
           class="border p-2 w-full mb-4" required>

    <button class="bg-blue-600 text-white px-4 py-2 rounded">
        Register
    </button>
</form>
@endsection