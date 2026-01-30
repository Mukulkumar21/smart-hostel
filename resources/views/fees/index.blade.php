@extends('layouts.app')

@section('content')

<!-- Heading + Add Button -->
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
        Fees
    </h1>

    <a href="{{ route('fees.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        + Add Fees
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

<!-- FEES TABLE -->
<x-dark-table>

    <!-- TABLE HEAD -->
    <x-slot name="head">
        <tr>
            <th class="p-3">Student</th>
            <th class="p-3">Room</th>
            <th class="p-3">Total Fees</th>
            <th class="p-3">Paid</th>
            <th class="p-3">Pending</th>
            <th class="p-3">Status</th>
            <th class="p-3">Action</th>
        </tr>
    </x-slot>

    <!-- TABLE BODY -->
    <x-slot name="body">
        @forelse($fees as $fee)
        <tr class="border-t dark:border-gray-600
                   hover:bg-gray-50 dark:hover:bg-gray-700 transition">

            <!-- Student -->
            <td class="p-3 font-semibold">
                {{ $fee->student->name ?? 'N/A' }}
            </td>

            <!-- Room -->
            <td class="p-3">
                {{ $fee->student->room->room_number ?? '-' }}
            </td>

            <!-- Total -->
            <td class="p-3">
                ₹ {{ $fee->total_fees }}
            </td>

            <!-- Paid -->
            <td class="p-3">
                ₹ {{ $fee->paid_fees }}
            </td>

            <!-- Pending -->
            <td class="p-3">
                ₹ {{ $fee->pending_fees }}
            </td>

            <!-- Status -->
            <td class="p-3">
                @if($fee->status === 'PAID')
                    <span class="px-2 py-1 rounded text-xs bg-green-600 text-white">
                        PAID
                    </span>
                @elseif($fee->status === 'PARTIAL')
                    <span class="px-2 py-1 rounded text-xs bg-yellow-500 text-white">
                        PARTIAL
                    </span>
                @else
                    <span class="px-2 py-1 rounded text-xs bg-red-600 text-white">
                        PENDING
                    </span>
                @endif
            </td>

            <!-- ACTIONS -->
            <td class="p-3 space-x-2">
                <a href="{{ route('fees.edit', $fee->id) }}"
                   class="px-3 py-1 bg-indigo-600 text-white rounded text-sm">
                    Edit
                </a>

                <a href="{{ route('fees.receipt.pdf', $fee->id) }}"
                   class="px-3 py-1 bg-green-600 text-white rounded text-sm">
                    PDF
                </a>
            </td>

        </tr>
        @empty
        <tr>
            <td colspan="7" class="p-4 text-center text-gray-400">
                No fees records found
            </td>
        </tr>
        @endforelse
    </x-slot>

</x-dark-table>

@endsection
