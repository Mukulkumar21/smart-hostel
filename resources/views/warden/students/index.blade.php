@extends('layouts.warden')

@section('content')

<h1 class="text-2xl font-bold mb-4">Students</h1>

{{-- 🔍 SEARCH & FILTER --}}
<form method="GET" action="{{ route('warden.students.index') }}"
      class="mb-4 grid grid-cols-1 md:grid-cols-4 gap-3">

    <input type="text"
           name="search"
           value="{{ request('search') }}"
           placeholder="Search name or email"
           class="border p-2 rounded bg-gray-800 text-white">

    <select name="room_id" class="border p-2 rounded bg-gray-800 text-white">
        <option value="">All Rooms</option>
        @foreach($rooms as $room)
            <option value="{{ $room->id }}"
                {{ request('room_id') == $room->id ? 'selected' : '' }}>
                {{ $room->room_number }}
            </option>
        @endforeach
    </select>

    <select name="status" class="border p-2 rounded bg-gray-800 text-white">
        <option value="">All Status</option>
        <option value="in"  {{ request('status') == 'in' ? 'selected' : '' }}>IN</option>
        <option value="out" {{ request('status') == 'out' ? 'selected' : '' }}>OUT</option>
    </select>

    <div class="flex gap-2">
        <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded">
            Filter
        </button>

        <a href="{{ route('warden.students.index') }}"
           class="px-4 py-2 border rounded text-white">
            Reset
        </a>
    </div>
</form>

{{-- SUCCESS MESSAGE --}}
@if(session('success'))
    <div class="bg-green-600/20 text-green-400 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

{{-- ERROR MESSAGE --}}
@if(session('error'))
    <div class="bg-red-600/20 text-red-400 p-3 rounded mb-4">
        {{ session('error') }}
    </div>
@endif

@if($students->isEmpty())
    <p class="text-gray-400">No students found.</p>
@else

<div class="bg-gray-800 rounded shadow overflow-x-auto">
<table class="w-full text-sm">
    <thead class="bg-gray-700 text-white">
        <tr>
            <th class="p-2">#</th>
            <th class="p-2">Name</th>
            <th class="p-2">Email</th>
            <th class="p-2">Room</th>
            <th class="p-2">Status</th>
            <th class="p-2">Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach($students as $student)
            <tr class="border-b border-gray-700 text-center">

                <td class="p-2">{{ $loop->iteration }}</td>
                <td class="p-2">{{ $student->name }}</td>
                <td class="p-2">{{ $student->email }}</td>

                <td class="p-2">
                    {{ $student->room?->room_number ?? '—' }}
                </td>

                <td class="p-2">
                    @if($student->isCurrentlyOut())
                        <span class="text-red-500 font-semibold">OUT</span>
                    @else
                        <span class="text-green-500 font-semibold">IN</span>
                    @endif
                </td>

                <td class="p-2 space-x-1">

                    <a href="{{ route('warden.students.show', $student) }}"
                       class="bg-blue-600 text-white px-3 py-1 rounded">
                        View
                    </a>

                    <a href="{{ route('warden.students.history', $student) }}"
                       class="bg-gray-600 text-white px-3 py-1 rounded">
                        History
                    </a>

                    @if($student->isCurrentlyOut())
                        <form method="POST"
                              action="{{ route('warden.students.in', $student) }}"
                              class="inline">
                            @csrf
                            <button type="submit"
                                    class="bg-green-600 text-white px-3 py-1 rounded">
                                IN
                            </button>
                        </form>
                    @else
                        <form method="POST"
                              action="{{ route('warden.students.out', $student) }}"
                              class="inline">
                            @csrf
                            <button type="submit"
                                    class="bg-red-600 text-white px-3 py-1 rounded">
                                OUT
                            </button>
                        </form>
                    @endif

                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>

@endif

@endsection
