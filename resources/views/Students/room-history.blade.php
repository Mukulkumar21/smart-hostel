@extends('layouts.app')

@section('content')

<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
        Room History – {{ $student->name }}
    </h1>

    <p class="text-gray-600 dark:text-gray-400">
        Student Email: {{ $student->email }}
    </p>
</div>

<!-- ROOM HISTORY TABLE -->
<x-dark-table>

    <!-- TABLE HEAD -->
    <x-slot name="head">
        <tr>
            <th class="p-3">Old Room</th>
            <th class="p-3">New Room</th>
            <th class="p-3">Changed At</th>
        </tr>
    </x-slot>

    <!-- TABLE BODY -->
    <x-slot name="body">
        @forelse($histories as $history)
            <tr class="border-t dark:border-gray-600
                       hover:bg-gray-50 dark:hover:bg-gray-700 transition">

                <td class="p-3 font-semibold">
                    {{ $history->oldRoom->room_number ?? 'N/A' }}
                </td>

                <td class="p-3 font-semibold">
                    {{ $history->newRoom->room_number ?? 'N/A' }}
                </td>

                <td class="p-3">
                    {{ \Carbon\Carbon::parse($history->changed_at)->format('d M Y, h:i A') }}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="p-4 text-center text-gray-400">
                    No room change history found
                </td>
            </tr>
        @endforelse
    </x-slot>

</x-dark-table>

<!-- BACK BUTTON -->
<div class="mt-6">
    <a href="{{ route('students.index') }}"
       class="bg-gray-600 hover:bg-gray-700
              text-white px-4 py-2 rounded">
        ← Back to Students
    </a>
</div>

@endsection
