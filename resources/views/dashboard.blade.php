@extends('layouts.warden')

@section('content')

<h1 class="text-2xl font-bold mb-6 text-gray-900 dark:text-gray-100">
    Welcome Warden 👋
</h1>

{{-- ===================== DASHBOARD STATS ===================== --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    {{-- TOTAL STUDENTS --}}
    <div class="bg-white dark:bg-gray-800 p-6 rounded shadow border-l-4 border-blue-600">
        <h3 class="text-sm text-gray-500 dark:text-gray-400">
            Total Students
        </h3>
        <p class="text-3xl font-bold text-blue-600">
            {{ $totalStudents }}
        </p>
    </div>

    {{-- TOTAL ROOMS --}}
    <div class="bg-white dark:bg-gray-800 p-6 rounded shadow border-l-4 border-green-600">
        <h3 class="text-sm text-gray-500 dark:text-gray-400">
            Total Rooms
        </h3>
        <p class="text-3xl font-bold text-green-600">
            {{ $totalRooms }}
        </p>
    </div>

    {{-- OCCUPIED ROOMS --}}
    <div class="bg-white dark:bg-gray-800 p-6 rounded shadow border-l-4 border-purple-600">
        <h3 class="text-sm text-gray-500 dark:text-gray-400">
            Occupied Rooms
        </h3>
        <p class="text-3xl font-bold text-purple-600">
            {{ $occupiedRooms }}
        </p>
    </div>

</div>

@endsection
