@extends('layouts.app')

@section('content')

<!-- Heading -->
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
        Room Movement Report – Room {{ $room->room_number }}
    </h1>

    <p class="text-gray-600 dark:text-gray-400">
        Capacity: {{ $room->capacity }} |
        Current Occupied: {{ $room->students->count() }}
    </p>
</div>
<a href="{{ route('rooms.export.excel', $room->id) }}"
   class="bg-green-600 text-white px-4 py-2 rounded mb-4 inline-block">
   Export Excel
</a>


<!-- MOVEMENTS TABLE -->
<x-dark-table>

    <!-- TABLE HEAD -->
    <x-slot name="head">
        <tr>
            <th class="p-3">Student</th>
            <th class="p-3">Movement</th>
            <th class="p-3">Date & Time</th>
            <th class="p-3">Reason</th>
        </tr>
    </x-slot>

    <!-- TABLE BODY -->
    <x-slot name="body">
        @forelse($movements as $move)
            <tr class="border-t dark:border-gray-600">

                <!-- Student -->
                <td class="p-3 font-semibold">
                    {{ $move->student->name }}
                </td>

                <!-- IN / OUT -->
                <td class="p-3">
                    @if($move->movement_type === 'IN')
                        <span class="px-2 py-1 text-xs bg-green-600 text-white rounded">
                            IN
                        </span>
                    @else
                        <span class="px-2 py-1 text-xs bg-red-600 text-white rounded">
                            OUT
                        </span>
                    @endif
                </td>

                <!-- Date -->
                <td class="p-3">
                    {{ \Carbon\Carbon::parse($move->moved_at)->format('d M Y, h:i A') }}
                </td>

                <!-- Reason -->
                <td class="p-3">
                    {{ $move->reason ?? '-' }}
                </td>

            </tr>
        @empty
            <tr>
                <td colspan="4" class="p-4 text-center text-gray-400">
                    No movement records found for this room
                </td>
            </tr>
        @endforelse
    </x-slot>

</x-dark-table>

<!-- BACK BUTTON -->
<div class="mt-6">
    <a href="{{ route('rooms.index') }}"
       class="bg-gray-600 text-white px-4 py-2 rounded">
        ← Back to Rooms
    </a>
</div>

@endsection
