@extends('layouts.student')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">

    <h2 class="text-xl font-bold mb-4">Gate Pass Request</h2>

    <form method="POST" action="{{ route('student.gatepass.submit') }}">
        @csrf

        <div class="mb-4">
            <label class="block font-semibold">Reason</label>
            <input type="text" name="reason" class="w-full border p-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">From Time</label>
            <input type="datetime-local" name="from_time" class="w-full border p-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">To Time</label>
            <input type="datetime-local" name="to_time" class="w-full border p-2" required>
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Send Request
        </button>
    </form>

</div>
@endsection