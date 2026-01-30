<h2 class="text-2xl font-bold mb-4">Students Fees</h2>

<table class="w-full border">
    <thead>
        <tr>
            <th>Student</th>
            <th>Total Fees</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($students as $student)
        <tr>
            <td>{{ $student->name }}</td>
            <td>₹ {{ $student->fees->sum('paid_amount') }}</td>
            <td>
                <a href="{{ route('warden.fees.show', $student->id) }}"
                   class="bg-blue-600 text-white px-3 py-1 rounded">
                    View
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>