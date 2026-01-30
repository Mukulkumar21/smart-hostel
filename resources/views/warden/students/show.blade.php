@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto bg-white dark:bg-gray-900 rounded shadow p-6">

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">
            Student Profile
        </h2>

        <a href="{{ route('warden.students.index') }}"
           class="text-blue-500 underline">
            ← Back
        </a>
    </div>

    {{-- PROFILE CARD --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        {{-- PHOTO --}}
        <div class="flex flex-col items-center">
            @if($student->photo)
                <img src="{{ asset('storage/'.$student->photo) }}"
                     class="w-32 h-32 rounded-full object-cover border">
            @else
                <div class="w-32 h-32 rounded-full bg-gray-300 flex items-center justify-center">
                    <span class="text-gray-600">No Photo</span>
                </div>
            @endif

            <span class="mt-3 px-3 py-1 rounded text-sm font-semibold
                {{ $student->isCurrentlyOut()
                    ? 'bg-red-100 text-red-600'
                    : 'bg-green-100 text-green-600' }}">
                {{ $student->isCurrentlyOut() ? 'OUT' : 'IN' }}
            </span>
        </div>

        {{-- DETAILS --}}
        <div class="md:col-span-2 space-y-3">

            <p><strong>Name:</strong> {{ $student->name }}</p>
            <p><strong>Email:</strong> {{ $student->email }}</p>
            <p><strong>Phone:</strong> {{ $student->phone ?? '—' }}</p>
            <p><strong>Gender:</strong> {{ ucfirst($student->gender ?? '—') }}</p>

            <p>
                <strong>Room:</strong>
                {{ $student->room?->room_number ?? 'Not Assigned' }}
            </p>

            <p>
                <strong>Admission Date:</strong>
                {{ optional($student->admission_date)->format('d M Y') ?? '—' }}
            </p>

        </div>
    </div>

    {{-- ACTION BUTTONS --}}
    <div class="mt-6 flex gap-3">

        {{-- HISTORY --}}
        <a href="{{ route('warden.students.history', $student) }}"
           class="bg-gray-700 text-white px-4 py-2 rounded">
            View History
        </a>
        <a href="{{ route('warden.students.edit', $student) }}"
   class="bg-yellow-500 text-white px-4 py-2 rounded">
    Edit Profile
</a>

        {{-- IN / OUT --}}
        @if($student->isCurrentlyOut())
            <form method="POST"
                  action="{{ route('warden.students.in', $student) }}">
                @csrf
                <button class="bg-green-600 text-white px-4 py-2 rounded">
                    Mark IN
                </button>
            </form>
        @else
            <form method="POST"
                  action="{{ route('warden.students.out', $student) }}">
                @csrf
                <button class="bg-red-600 text-white px-4 py-2 rounded">
                    Mark OUT
                </button>
            </form>
        @endif

    </div>

</div>

@endsection