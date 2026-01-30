@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 bg-gray-900 text-gray-100 p-6 rounded shadow">

    <h1 class="text-2xl font-bold mb-6">Add Student</h1>

    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="bg-red-800 text-red-100 p-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('warden.students.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <div class="mb-4">
            <label class="block mb-1">Name</label>
            <input name="name" value="{{ old('name') }}"
                class="w-full bg-gray-800 text-gray-100 border border-gray-600 rounded px-3 py-2"
                required>
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label class="block mb-1">Email</label>
            <input name="email" type="email" value="{{ old('email') }}"
                class="w-full bg-gray-800 text-gray-100 border border-gray-600 rounded px-3 py-2"
                required>
        </div>

        <!-- Phone -->
        <div class="mb-4">
            <label class="block mb-1">Phone</label>
            <input name="phone" value="{{ old('phone') }}"
                class="w-full bg-gray-800 text-gray-100 border border-gray-600 rounded px-3 py-2">
        </div>

        <!-- Gender -->
        <div class="mb-4">
            <label class="block mb-1">Gender</label>
            <select name="gender"
                class="w-full bg-gray-800 text-gray-100 border border-gray-600 rounded px-3 py-2">
                <option value="" class="bg-white text-black">Select</option>
                <option value="male" class="bg-white text-black">Male</option>
                <option value="female" class="bg-white text-black">Female</option>
                <option value="other" class="bg-white text-black">Other</option>
            </select>
        </div>

        <!-- Room -->
        <div class="mb-4">
            <label class="block mb-1">Assign Room</label>
            <select name="room_id"
                class="w-full bg-gray-800 text-gray-100 border border-gray-600 rounded px-3 py-2">
                <option value="" class="bg-white text-black">No Room</option>
                @foreach($rooms as $room)
                    <option value="{{ $room->id }}" class="bg-white text-black">
                        {{ $room->room_number }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Student Photo -->
        <div class="mb-6">
            <label class="block mb-1">Student Photo</label>
            <input type="file" name="photo"
                class="w-full bg-gray-800 text-gray-100 border border-gray-600 rounded px-3 py-2">
        </div>

        <!-- Submit -->
        <button
            class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded">
            Save Student
        </button>

    </form>
</div>
@endsection