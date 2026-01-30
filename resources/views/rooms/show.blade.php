@extends('layouts.app')

@section('content')

<!-- Room Heading -->
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
        Room {{ $room->room_number }}
    </h1>
    <p class="text-gray-600 dark:text-gray-400">
        Capacity: {{ $room->capacity }} |
        Occupied: {{ $room->students->count() }}
    </p>
</div>

<!-- Flash Messages -->
@if(session('success'))
    <div class="bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-200 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-200 p-3 rounded mb-4">
        {{ session('error') }}
    </div>
@endif

<!-- ================= IN FORM ================= -->
<div class="bg-white dark:bg-gray-800 p-4 rounded shadow mb-6">
    <h2 class="text-lg font-semibold mb-3 text-green-600">
        Student IN
    </h2>

    @if($room->is_full)
        <p class="text-red-600 font-semibold">
            Room is full. No more students can enter.
        </p>
    @else
        <form method="POST" action="{{ route('room.movement.in') }}">
            @csrf

            <input type="hidden" name="room_id" value="{{ $room->id }}">

            <select name="student_id" class="border p-2 rounded w-full mb-3" required>
                <option value="">Select Student</option>
                @foreach($availableStudents as $student)
                    <option value="{{ $student->id }}">
                        {{ $student->name }}
                    </option>
                @endforeach
            </select>

            <button type="submit"
                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                IN
            </button>
        </form>
    @endif
</div>

<!-- ================= OUT FORM ================= -->
<div class="bg-white dark:bg-gray-800 p-4 rounded shadow mb-6">
    <h2 class="text-lg font-semibold mb-3 text-red-600">
        Student OUT
    </h2>

    @if($room->students->isEmpty())
        <p class="text-gray-500">
            No students currently in this room.
        </p>
    @else
        <form method="POST" action="{{ route('room.movement.out') }}">
            @csrf

            <select name="student_id" class="border p-2 rounded w-full mb-3" required>
                <option value="">Select Student</option>
                @foreach($room->students as $student)
                    <option value="{{ $student->id }}">
                        {{ $student->name }}
                    </option>
                @endforeach
            </select>

            <button type="submit"
                class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                OUT
            </button>
        </form>
    @endif
</div>

<!-- ================= CURRENT STUDENTS ================= -->
<div class="bg-white dark:bg-gray-800 p-4 rounded shadow">
    <h2 class="text-lg font-semibold mb-3">
        Students in Room
    </h2>

    @if($room->students->isEmpty())
        <p class="text-gray-500">
            No students in this room.
        </p>
    @else
        <ul class="list-disc ml-6">
            @foreach($room->students as $student)
                <li>{{ $student->name }}</li>
            @endforeach
        </ul>
    @endif
</div>

@endsection
