@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">Monthly Fee Report</h1>

<!-- FILTER + DOWNLOAD -->
<form method="GET"
      action="{{ route('fees.report') }}"
      class="bg-white p-4 rounded shadow mb-6">

    <div class="flex flex-wrap gap-4 items-center">

        <!-- MONTH INPUT (YAHI MONTH FILL KARNA HAI) -->
        <input type="text"
               name="month"
               value="{{ $month ?? '' }}"
               placeholder="e.g. Jan 2026"
               class="border p-2 rounded w-48">

        <!-- VIEW REPORT -->
        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            View Report
        </button>

        <!-- DOWNLOAD CSV (TAB DIKHEGA JAB MONTH HOGA) -->
        @if(!empty($month))
            <a href="{{ route('fees.report.csv', ['month' => $month]) }}"
               class="bg-green-700 text-white px-4 py-2 rounded">
               Download CSV
            </a>
        @endif
@if(!empty($month))
    <a href="{{ route('fees.report.pdf', ['month' => $month]) }}"
       class="bg-red-600 text-white px-4 py-2 rounded">
       Download PDF
    </a>
@endif

    </div>
</form>

<!-- SUMMARY CARDS -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <div class="bg-white p-4 rounded shadow border-l-4 border-green-600">
        <h3 class="text-gray-500">Total Collected</h3>
        <p class="text-2xl font-bold text-green-600">
            ₹{{ $totalCollected }}
        </p>
    </div>

    <div class="bg-white p-4 rounded shadow border-l-4 border-red-600">
        <h3 class="text-gray-500">Total Pending</h3>
        <p class="text-2xl font-bold text-red-600">
            ₹{{ $totalPending }}
        </p>
    </div>
</div>

<!-- FEES TABLE -->
<div class="bg-white shadow rounded">
    <table class="w-full">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3 text-left">Student</th>
                <th class="p-3 text-left">Month</th>
                <th class="p-3 text-left">Amount</th>
                <th class="p-3 text-left">Status</th>
            </tr>
        </thead>

        <tbody>
        @forelse($fees as $fee)
            <tr class="border-t">
                <td class="p-3">{{ $fee->student->name }}</td>
                <td class="p-3">{{ $fee->month }}</td>
                <td class="p-3">₹{{ $fee->amount }}</td>
                <td class="p-3">
                    @if($fee->status === 'Paid')
                        <span class="text-green-600 font-semibold">Paid</span>
                    @else
                        <span class="text-red-600 font-semibold">Pending</span>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="p-4 text-center text-gray-500">
                    No records found
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

@endsection
