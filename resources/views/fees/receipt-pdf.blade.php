<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Fee Receipt</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        .header h2 {
            margin: 0;
        }
        .details, .amount {
            margin-top: 20px;
            width: 100%;
        }
        .details td {
            padding: 5px;
        }
        .amount {
            border: 1px solid #000;
            border-collapse: collapse;
        }
        .amount th, .amount td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        .footer {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
        }
        .signature {
            text-align: right;
        }
    </style>
</head>
<body>

<div class="header">
    <div class="logo">
        <img src="{{ public_path('logo.png') }}" width="80">
    </div>

    <div class="title">
        <h2>SMART HOSTEL</h2>
        <p>Official Fee Receipt</p>
    </div>
</div>

<table class="details">
    <tr>
        <td><strong>Student Name:</strong> {{ $fee->student->name }}</td>
        <td><strong>Date:</strong> {{ now()->format('d-m-Y') }}</td>
    </tr>
    <tr>
        <td><strong>Room No:</strong> {{ $fee->student->room->room_number }}</td>
        <td><strong>Receipt No:</strong> REC-{{ $fee->id }}</td>
    </tr>
</table>

<table class="amount">
    <tr>
        <th>Description</th>
        <th>Amount (₹)</th>
    </tr>
    <tr>
        <td>Hostel Fees</td>
        <td>{{ number_format($fee->amount, 2) }}</td>
    </tr>
    <tr>
        <th>Total</th>
        <th>{{ number_format($fee->amount, 2) }}</th>
    </tr>
</table>

<p>
    <strong>Amount in Words:</strong><br>
    {{ \App\Helpers\NumberToWords::convert($fee->amount) }} rupees only
</p>

<div class="footer">
    <div>
        <p><strong>Paid By:</strong> {{ ucfirst($fee->payment_mode) }}</p>
    </div>
    <div class="signature">
        <p>_____________________</p>
        <p>Authorized Signature</p>
    </div>
</div>

</body>
</html>