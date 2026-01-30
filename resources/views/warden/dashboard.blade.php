@extends('layouts.warden')

@section('content')

<h1 class="text-2xl font-bold mb-6">
    Welcome Warden 👋
</h1>

{{-- ===================== DASHBOARD STATS ===================== --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <div class="card p-6 rounded shadow border-l-4 border-blue-600">
        <h3 class="text-sm opacity-70">Total Students</h3>
        <p class="text-3xl font-bold text-blue-600">
            {{ $totalStudents }}
        </p>
    </div>

    <div class="card p-6 rounded shadow border-l-4 border-green-600">
        <h3 class="text-sm opacity-70">Total Rooms</h3>
        <p class="text-3xl font-bold text-green-600">
            {{ $totalRooms }}
        </p>
    </div>

    <div class="card p-6 rounded shadow border-l-4 border-purple-600">
        <h3 class="text-sm opacity-70">Occupied Rooms</h3>
        <p class="text-3xl font-bold text-purple-600">
            {{ $occupiedRooms }}
        </p>
    </div>

</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">

    <div class="card p-6 rounded shadow">
        <h3 class="text-sm opacity-70">Available Rooms</h3>
        <p class="text-3xl font-bold">
            {{ $availableRooms }}
        </p>
    </div>

    <div class="card p-6 rounded shadow">
        <h3 class="text-sm opacity-70">Today IN</h3>
        <p class="text-3xl font-bold text-green-600">
            {{ $todayIn }}
        </p>
    </div>

    <div class="card p-6 rounded shadow">
        <h3 class="text-sm opacity-70">Today OUT</h3>
        <p class="text-3xl font-bold text-red-600">
            {{ $todayOut }}
        </p>
    </div>

</div>

{{-- ===================== STUDENTS CURRENTLY OUT ===================== --}}
<div class="card mt-8 p-6 rounded shadow bg-red-600 text-white">
    <h3 class="text-lg font-semibold mb-2">
        🚨 Students Currently OUT
    </h3>
    <p class="text-3xl font-bold">
        {{ $studentsOut }}
    </p>
</div>

{{-- ===================== ATTENDANCE ANALYTICS ===================== --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-10">

    <div class="card p-4 rounded shadow">
        <h3 class="font-bold mb-2">Today IN vs OUT</h3>
        <canvas id="todayChart"></canvas>
    </div>

    <div class="card p-4 rounded shadow">
        <h3 class="font-bold mb-2">Currently IN vs OUT</h3>
        <canvas id="statusChart"></canvas>
    </div>

</div>

<div class="card p-4 rounded shadow mt-6">
    <h3 class="font-bold mb-2">Last 7 Days Movement</h3>
    <canvas id="weeklyChart"></canvas>
</div>

{{-- ===================== RECENT IN / OUT ===================== --}}
<div class="card p-4 rounded shadow mt-6">
    <h3 class="text-lg font-bold mb-3">Recent IN / OUT</h3>

    @if($recentMovements->isEmpty())
        <p class="opacity-70">No recent movements found.</p>
    @else
        <table class="w-full text-sm">
            <thead>
                <tr class="opacity-70 border-b">
                    <th class="py-2 text-left">Name</th>
                    <th class="text-left">Type</th>
                    <th class="text-left">Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentMovements as $move)
                    <tr class="border-b">
                        <td class="py-2">
                            {{ $move->student->name }}
                        </td>
                        <td class="{{ $move->movement_type === 'OUT' ? 'text-red-600' : 'text-green-600' }}">
                            {{ $move->movement_type }}
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($move->moved_at)->format('d M, h:i A') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
new Chart(document.getElementById('todayChart'), {
    type: 'bar',
    data: {
        labels: ['IN', 'OUT'],
        datasets: [{
            data: [{{ $todayIn }}, {{ $todayOut }}],
            backgroundColor: ['#22c55e', '#ef4444']
        }]
    }
});

new Chart(document.getElementById('statusChart'), {
    type: 'pie',
    data: {
        labels: ['IN', 'OUT'],
        datasets: [{
            data: [{{ $currentlyIn }}, {{ $currentlyOut }}],
            backgroundColor: ['#22c55e', '#ef4444']
        }]
    }
});

new Chart(document.getElementById('weeklyChart'), {
    type: 'line',
    data: {
        labels: @json($days),
        datasets: [
            {
                label: 'IN',
                data: @json($weeklyIn),
                borderColor: '#22c55e',
                tension: 0.3
            },
            {
                label: 'OUT',
                data: @json($weeklyOut),
                borderColor: '#ef4444',
                tension: 0.3
            }
        ]
    }
});
</script>
@endpush
