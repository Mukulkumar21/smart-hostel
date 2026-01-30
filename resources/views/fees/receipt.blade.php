<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Fee Receipt</title>
    <style>
        body { font-family: DejaVu Sans; font-size: 14px; }
        .header { text-align: center; margin-bottom: 20px; }
        .box { border: 1px solid #333; padding: 15px; }
        table { width: 100%; border-collapse: collapse; }
        td, th { padding: 8px; border: 1px solid #333; }
        .right { text-align: right; }
    </style>
</head>
<body>

<div class="header">
    <h2>Smart Hostel</h2>
    <p><strong>Fee Receipt</strong></p>
</div>

<div class="box">
    <p><strong>Student Name:</strong> {{ $fee->student->name }}</p>
    <p><strong>Room Number:</strong> {{ $fee->student->room->room_number ?? '-' }}</p>
   <p><strong>Date:</strong>
    {{ \Carbon\Carbon::parse($fee->payment_date)->format('d M Y') }}
</p>

</div>

<br>

<table>
    <tr>
        <th>Description</th>
        <th class="right">Amount (₹)</th>
    </tr>
    <tr>
        <td>Total Fees</td>
        <td class="right">{{ $fee->total_fees }}</td>
    </tr>
    <tr>
        <td>Paid Fees</td>
        <td class="right">{{ $fee->paid_fees }}</td>
    </tr>
    <tr>
        <td><strong>Pending Fees</strong></td>
        <td class="right"><strong>{{ $fee->pending_fees }}</strong></td>
    </tr>
</table>

<br>
<p><strong>Amount in Words:</strong> {{ $amountInWords }}</p>

<p><strong>Status:</strong> {{ $fee->status }}</p>

<br><br>
<p style="text-align:center;">
    This is a system generated receipt.
</p>

</body>
</html>
