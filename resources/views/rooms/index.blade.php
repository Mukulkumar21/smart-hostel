@extends('layouts.app')

@section('content')

<!-- Heading + Add Button -->
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
        Rooms
    </h1>

    <a href="{{ route('rooms.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        + Add Room
    </a>
</div>

<!-- Success Message -->
@if(session('success'))
    <div class="bg-green-100 dark:bg-green-900
                text-green-700 dark:text-green-200
                p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<!-- ROOMS TABLE -->
<x-dark-table>

    <!-- TABLE HEAD -->
    <x-slot name="head">
        <tr>
            <th class="p-3">Room Number</th>
            <th class="p-3">Capacity</th>
            <th class="p-3">Occupied</th>
            <th class="p-3">Status</th>
            <th class="p-3">Actions</th>
        </tr>
    </x-slot>

    <!-- TABLE BODY -->
    <x-slot name="body">
        @forelse($rooms as $room)
        <tr class="border-t dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700">

            <!-- Room Number -->
            <td class="p-3 font-semibold text-blue-600">
                <a href="{{ route('rooms.show', $room->id) }}">
                    {{ $room->room_number }}
                </a>
            </td>

            <td class="p-3">{{ $room->capacity }}</td>

            <td class="p-3">
                {{ $room->students_count }} / {{ $room->capacity }}
            </td>

            <!-- Status -->
            <td class="p-3">
                @if($room->students_count >= $room->capacity)
                    <span class="px-2 py-1 text-xs bg-red-600 text-white rounded">
                        Full
                    </span>
                @else
                    <span class="px-2 py-1 text-xs bg-green-600 text-white rounded">
                        Available
                    </span>
                @endif
            </td>

            <!-- Actions -->
            <td class="p-3 space-x-2">
                <a href="{{ route('rooms.show', $room->id) }}"
                   class="px-3 py-1 bg-blue-600 text-white rounded">
                    Open
                </a>

                <a href="{{ route('rooms.movements', $room->id) }}"
                   class="px-3 py-1 bg-indigo-600 text-white rounded">
                    View Movements
                </a>
            </td>

        </tr>
        @empty
        <tr>
            <td colspan="5" class="p-4 text-center text-gray-400">
                No rooms found
            </td>
        </tr>
        @endforelse
    </x-slot>

</x-dark-table>

@endsection
