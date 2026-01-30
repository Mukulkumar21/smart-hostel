@extends('layouts.student')

@section('content')
<div class="max-w-6xl mx-auto">

    <h1 class="text-2xl font-bold mb-6">
        Welcome, {{ $student->name }}
    </h1>

    <!-- ================= DASHBOARD CARDS ================= -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

        <!-- Email -->
        <div class="bg-white p-5 rounded shadow">
            <h3 class="text-sm text-gray-500">Email</h3>
            <p class="text-lg font-semibold">
                {{ $student->email }}
            </p>
        </div>

        <!-- Room -->
        <div class="bg-white p-5 rounded shadow">
            <h3 class="text-sm text-gray-500">Room</h3>
            <p class="text-xl font-semibold">
                {{ $student->room->room_no ?? 'Not Assigned' }}
            </p>
        </div>

        <!-- Status -->
        <div class="bg-white p-5 rounded shadow">
            <h3 class="text-sm text-gray-500">Current Status</h3>

            @if($currentStatus === 'IN')
                <p class="text-xl font-semibold text-green-600">
                    IN (Inside Hostel)
                </p>
            @else
                <p class="text-xl font-semibold text-red-600">
                    OUT (Outside Hostel)
                </p>
            @endif
        </div><!-- ================= GATE PASS SECTION ================= -->
<div class="bg-white p-5 rounded shadow mb-6">
    <h3 class="text-lg font-bold mb-2">Gate Pass</h3>

    @if(!isset($latestGatePass) || !$latestGatePass)
        <p class="text-gray-600 mb-2">
            No gate pass requested
        </p>

        <a href="{{ route('student.gatepass.form') }}"
           class="inline-block bg-blue-600 text-white px-4 py-2 rounded">
            Request Gate Pass
        </a>

    @elseif($latestGatePass->status === 'PENDING')
        <p class="text-yellow-600 font-semibold">
            Status: Pending (Waiting for Warden approval)
        </p>

    @elseif($latestGatePass->status === 'APPROVED')
        <p class="text-green-600 font-semibold">
            Status: Approved ✅
        </p>

    @elseif($latestGatePass->status === 'REJECTED')
        <p class="text-red-600 font-semibold">
            Status: Rejected ❌
        </p>

        <a href="{{ route('student.gatepass.form') }}"
           class="inline-block mt-2 bg-blue-600 text-white px-4 py-2 rounded">
            Request Again
        </a>
    @endif
</div>

    </div>

    <!-- ================= FEES SECTION ================= -->
    <div class="bg-white p-6 rounded shadow">

        <h2 class="text-xl font-bold mb-4">Your Fees</h2>

        <div class="overflow-x-auto">
            <table class="w-full border border-gray-300 text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2 border">Receipt No</th>
                        <th class="p-2 border">Total</th>
                        <th class="p-2 border">Paid</th>
                        <th class="p-2 border">Pending</th>
                        <th class="p-2 border">Status</th>
                        <th class="p-2 border">Receipt</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($fees as $fee)
                        <tr class="text-center border-t">
                            <td class="p-2 border">
                                {{ $fee->receipt_no }}
                            </td>

                            <td class="p-2 border">
                                ₹ {{ $fee->amount }}
                            </td>

                            <td class="p-2 border">
                                ₹ {{ $fee->paid_amount }}
                            </td>

                            <td class="p-2 border">
                                ₹ {{ $fee->amount - $fee->paid_amount }}
                            </td>

                            <td class="p-2 border">
                                {{ strtoupper($fee->status) }}
                            </td>

                            <td class="p-2 border">
                                @if($fee->receipt_path)
                                    <a href="{{ route('student.fees.receipt', $fee->id) }}"
                                       class="text-blue-600 underline"
                                       target="_blank">
                                        Download
                                    </a>
                                @else
                                    <span class="text-gray-400">N/A</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6"
                                class="p-4 text-center text-gray-500">
                                No fee records found
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </div>

</div>
@endsection