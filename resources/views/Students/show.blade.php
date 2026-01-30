@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto bg-white shadow rounded p-6">

    <!-- PROFILE HEADER -->
    <div class="flex items-center gap-6 mb-6">

        {{-- STUDENT IMAGE --}}
        @if($student->image)
            <img src="{{ asset('storage/' . $student->image) }}"
                 class="w-32 h-32 rounded-full object-cover border">
        @else
            <div class="w-32 h-32 rounded-full bg-gray-200 flex items-center justify-center text-gray-500">
                No Photo
            </div>
        @endif

        <div>
            <h1 class="text-2xl font-bold">{{ $student->name }}</h1>
            <p class="text-gray-500">{{ $student->email }}</p>
            <p class="text-sm text-gray-400">
                Room: {{ $student->room_number ?? 'N/A' }}
            </p>
        </div>
    </div>

    <!-- STUDENT DETAILS -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div>
            <h3 class="font-semibold text-gray-600">Phone</h3>
            <p>{{ $student->phone ?? '-' }}</p>
        </div>

        <div>
            <h3 class="font-semibold text-gray-600">Gender</h3>
            <p>{{ $student->gender ?? '-' }}</p>
        </div>

        <div>
            <h3 class="font-semibold text-gray-600">Admission Date</h3>
            <p>{{ $student->admission_date ?? '-' }}</p>
        </div>

        <div>
            <h3 class="font-semibold text-gray-600">Parent Phone</h3>
            <p>{{ $student->parent_phone ?? '-' }}</p>
        </div>

        <div class="md:col-span-2">
            <h3 class="font-semibold text-gray-600">Address</h3>
            <p>{{ $student->address ?? '-' }}</p>
        </div>

    </div>

    <!-- ACTION BUTTONS -->
    <div class="mt-6 flex gap-3">
        <a href="{{ route('students.edit', $student) }}"
           class="bg-yellow-500 text-white px-4 py-2 rounded">
            Edit
        </a>

        <a href="{{ route('students.index') }}"
           class="bg-gray-500 text-white px-4 py-2 rounded">
            Back
        </a>
    </div>

</div>

@endsection
