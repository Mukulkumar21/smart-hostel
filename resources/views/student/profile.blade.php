@extends('layouts.student')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">

    <h1 class="text-2xl font-bold mb-6">My Profile</h1>

    <div class="space-y-4">
        <div>
            <strong>Name:</strong>
            {{ $student->name }}
        </div>
<div class="mt-4">
    <strong>Current Status:</strong>

    @if($currentStatus === 'IN')
        <span class="text-green-600 font-semibold">IN (Inside Hostel)</span>
    @else
        <span class="text-red-600 font-semibold">OUT (Outside Hostel)</span>
    @endif
</div>
        <div>
            <strong>Email:</strong>
            {{ $student->email }}
        </div>

        <div>
            <strong>Phone:</strong>
            {{ $student->phone ?? 'N/A' }}
        </div>

        <div>
            <strong>Gender:</strong>
            {{ $student->gender ?? 'N/A' }}
        </div>

        <div>
            <strong>Room:</strong>
            {{ $student->room->room_no ?? 'Not Assigned' }}
        </div>

        <div>
            <strong>Admission Date:</strong>
            {{ $student->admission_date ?? 'N/A' }}
        </div>
    </div>

</div>
@endsection