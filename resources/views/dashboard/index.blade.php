@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6 text-gray-900 dark:text-gray-100">
    Dashboard Analytics
</h1>

<!-- ================= DASHBOARD CARDS ================= -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 w-full">

    <div class="bg-white dark:bg-gray-800 p-6 rounded shadow border-l-4 border-blue-600">
        <h3 class="text-sm text-gray-500 dark:text-gray-400">Total Students</h3>
        <p class="text-3xl font-bold text-blue-600">
            {{ $totalStudents }}
        </p>
    </div>

    <div class="bg-white dark:bg-gray-800 p-6 rounded shadow border-l-4 border-purple-600">
        <h3 class="text-sm text-gray-500 dark:text-gray-400">Total Rooms</h3>
        <p class="text-3xl font-bold text-purple-600">
            {{ $totalRooms }}
        </p>
    </div>

    <div class="bg-white dark:bg-gray-800 p-6 rounded shadow border-l-4 border-green-600">
        <h3 class="text-sm text-gray-500 dark:text-gray-400">Occupied Rooms</h3>
        <p class="text-3xl font-bold text-green-600">
            {{ $occupiedRooms }}
        </p>
    </div>

    <div class="bg-white dark:bg-gray-800 p-6 rounded shadow border-l-4 border-indigo-600">
        <h3 class="text-sm text-gray-500 dark:text-gray-400">Fees Collected</h3>
        <p class="text-3xl font-bold text-indigo-600">
            ₹ {{ $totalFeesCollected }}
        </p>
    </div>

    <div class="bg-white dark:bg-gray-800 p-6 rounded shadow border-l-4 border-red-600">
        <h3 class="text-sm text-gray-500 dark:text-gray-400">Pending Fees</h3>
        <p class="text-3xl font-bold text-red-600">
            ₹ {{ $totalPendingFees }}
        </p>
    </div>

</div>

<!-- ================= MOVEMENT CHART ================= -->
<div class="bg-white dark:bg-gray-800 p-6 rounded shadow mt-10">
    <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-gray-100">
        IN / OUT Movement Report
    </h2>

    <canvas id="movementChart" height="120"></canvas>
</div>

<!-- ================= CHART SCRIPT ================= -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const ctx = document.getElementById('movementChart');
    if (!ctx) return;

    const movementData = @json($movementData);

    const labels = movementData.map(item => item.date);
    const inData = movementData.map(item => item.in_count);
    const outData = movementData.map(item => item.out_count);

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'IN',
                    data: inData,
                    backgroundColor: '#22C55E'
                },
                {
                    label: 'OUT',
                    data: outData,
                    backgroundColor: '#EF4444'
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                }
            }
        }
    });
});
</script>

@endsection
