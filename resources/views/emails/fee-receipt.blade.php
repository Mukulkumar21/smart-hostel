<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Fee Receipt</title>
</head>
<body>

<h2>Smart Hostel – Fee Receipt</h2>

<p><strong>Student Name:</strong> {{ $fee->student->name }}</p>
<p><strong>Room:</strong> {{ $fee->student->room->room_no ?? 'N/A' }}</p>

<hr>

<p><strong>Total Fees:</strong> ₹{{ $fee->total_fees }}</p>
<p><strong>Paid Fees:</strong> ₹{{ $fee->paid_fees }}</p>
<p><strong>Pending Fees:</strong> ₹{{ $fee->pending_fees }}</p>

<p><strong>Status:</strong> {{ $fee->status }}</p>
<p><strong>Receipt No:</strong> {{ $fee->receipt_no }}</p>

<hr>

<p>📎 PDF receipt attached with this email.</p>

<p>Thanks,<br>Smart Hostel</p>

</body>
</html>
