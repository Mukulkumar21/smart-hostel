@extends('layouts.app')

@section('content')

<h2 class="text-2xl font-bold mb-4">
    {{ $student->name }} — Movement History
</h2>

<a href="{{ route('warden.students.index') }}"
   class="text-blue-500 underline mb-4 inline-block">
    ← Back to Students
</a>

@if($movements->isEmpty())
    <p class="text-gray-400 mt-4">No movement history found.</p>
@else
<table class="w-full mt-4 text-sm border">
    <thead class="bg-gray-800 text-white">
        <tr>
            <th class="p-2">Type</th>
            <th class="p-2">Room</th>
            <th class="p-2">Date & Time</th>
        </tr>
    </thead>
    <tbody>
        @foreach($movements as $move)
            <tr class="border-b text-center">
                <td class="p-2 {{ $move->movement_type === 'OUT' ? 'text-red-600' : 'text-green-600' }}">
                    {{ $move->movement_type }}
                </td>

                <td class="p-2">
                    {{ optional($move->room)->room_number ?? '-' }}
                </td>

                <td class="p-2">
                    {{ \Carbon\Carbon::parse($move->moved_at)->format('d M Y, h:i A') }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endif

@endsection