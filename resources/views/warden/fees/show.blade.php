<h2 class="text-2xl font-bold mb-4">
    Fees – {{ $student->name }}
</h2>

<table class="w-full border">
    <thead>
        <tr>
            <th>Receipt No</th>
            <th>Total</th>
            <th>Paid</th>
            <th>Status</th>
            <th>Receipt</th>
        </tr>
    </thead>
    <tbody>
    @foreach($fees as $fee)
        <tr>
            <td>{{ $fee->receipt_no }}</td>
            <td>₹{{ $fee->amount }}</td>
            <td>₹{{ $fee->paid_amount }}</td>
            <td>
                <span class="{{ $fee->status == 'paid' ? 'text-green-600' : 'text-red-600' }}">
                    {{ strtoupper($fee->status) }}
                </span>
            </td>
            <td>
                <a href="{{ route('warden.fees.receipt', $fee->id) }}"
                   class="text-blue-600 underline">
                    Download
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>