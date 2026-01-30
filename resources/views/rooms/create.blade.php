@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-4">Add Room</h1>

@if($errors->any())
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('rooms.store') }}"
      class="bg-white p-6 rounded shadow max-w-md">

    @csrf

    <div class="mb-4">
        <label class="block mb-1">Room Number</label>
        <input type="text" name="room_number"
               class="w-full border p-2 rounded"
               required>
    </div>

    <div class="mb-4">
        <label class="block mb-1">Capacity</label>
        <input type="number" name="capacity"
               class="w-full border p-2 rounded"
               min="1" required>
    </div>

    <button class="bg-blue-600 text-white px-4 py-2 rounded">
        Save Room
    </button>

</form>

@endsection
