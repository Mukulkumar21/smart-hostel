<!DOCTYPE html>
<html>
<head>
    <title>Students List</title>
    <style>
        body { font-family: DejaVu Sans; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 6px; }
        th { background: #eee; }
    </style>
</head>
<body>

<h2>Students List</h2>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Room</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($students as $i => $s)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $s->name }}</td>
            <td>{{ $s->email }}</td>
            <td>{{ $s->room?->room_number ?? '-' }}</td>
            <td>{{ $s->isCurrentlyOut() ? 'OUT' : 'IN' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>