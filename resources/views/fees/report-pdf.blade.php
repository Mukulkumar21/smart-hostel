<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Monthly Fee Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        h1 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background: #f2f2f2; }
        .summary { margin-top: 20px; }
    </style>
</head>
<body>

<h1>Monthly Fee Report</h1>
<p><strong>Month:</strong> {{ $month }}</p>

<div class="summary">
    <p><strong>Total Collected:</strong> ₹{{ $totalCollected }}</p>
    <p><strong>Total Pending:</strong> ₹{{ $totalPending }}</p>
</div>

<table>
    <thead>
        <tr>
            <th>Student</th>
            <th>Month</th>
            <th>Amount</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($fees as $fee)
        <tr>
            <td>{{ $fee->student->name }}</td>
            <td>{{ $fee->month }}</td>
            <td>{{ $fee->amount }}</td>
            <td>{{ $fee->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
