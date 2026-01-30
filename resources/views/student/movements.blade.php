@extends('layouts.student')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-6 rounded shadow">

    <h1 class="text-2xl font-bold mb-6">Room Movement History</h1>

    <div class="overflow-x-auto">
        <table class="w-full border border-gray-300 text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border">#</th>
                    <th class="p-2 border">Type</th>
                    <th class="p-2 border">Date & Time</th>
                    <th class="p-2 border">Reason</th>
                </tr>
            </thead>
            <tbody>
                @forelse($movements as $index => $move)
                <tr class="text-center border-t">
                    <td class="p-2 border">{{ $index + 1 }}</td>

                    <td class="p-2 border">
                        @if($move->movement_type === 'IN')
                            <span class="text-green-600 font-semibold">IN</span>
                        @else
                            <span class="text-red-600 font-semibold">OUT</span>
                        @endif
                    </td>

                    <td class="p-2 border">
                        {{ $move->created_at->format('d M Y, h:i A') }}
                    </td>

                    <td class="p-2 border">
                        {{ $move->reason ?? '—' }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-4 text-center text-gray-500">
                        No movement records found
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection