@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6 text-gray-900 dark:text-gray-100">
    Add Student
</h1>

<form action="{{ route('students.store') }}"
      method="POST"
      enctype="multipart/form-data"
      class="bg-white dark:bg-gray-800 p-6 rounded shadow max-w-2xl">

    @csrf

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        {{-- Name --}}
        <div>
            <label class="block mb-1 font-semibold">Name</label>
            <input type="text" name="name"
                   class="w-full border p-2 rounded" required>
        </div>

        {{-- Email --}}
        <div>
            <label class="block mb-1 font-semibold">Email</label>
            <input type="email" name="email"
                   class="w-full border p-2 rounded" required>
        </div>

        {{-- Phone --}}
        <div>
            <label class="block mb-1 font-semibold">Phone</label>
            <input type="text" name="phone"
                   class="w-full border p-2 rounded">
        </div>

        {{-- Gender --}}
        <div>
            <label class="block mb-1 font-semibold">Gender</label>
            <select name="gender" class="w-full border p-2 rounded">
                <option value="">Select</option>
                <option>Male</option>
                <option>Female</option>
                <option>Other</option>
            </select>
        </div>

        {{-- Admission Date --}}
        <div>
            <label class="block mb-1 font-semibold">Admission Date</label>
            <input type="date" name="admission_date"
                   class="w-full border p-2 rounded">
        </div>

        {{-- Parent Phone --}}
        <div>
            <label class="block mb-1 font-semibold">Parent Phone</label>
            <input type="text" name="parent_phone"
                   class="w-full border p-2 rounded">
        </div>

        {{-- Address --}}
        <div class="md:col-span-2">
            <label class="block mb-1 font-semibold">Address</label>
            <textarea name="address"
                      class="w-full border p-2 rounded"></textarea>
        </div>

        {{-- Assign Room --}}
        <div class="md:col-span-2">
            <label class="block mb-1 font-semibold">Assign Room</label>

            <select name="room_id" class="w-full border p-2 rounded">
                <option value="">No Room</option>

                @foreach($rooms as $room)
                    <option value="{{ $room->id }}"
                        {{ $room->students_count >= $room->capacity ? 'disabled' : '' }}>
                        {{ $room->room_number }}
                        ({{ $room->students_count }}/{{ $room->capacity }})
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Photo --}}
        <div class="md:col-span-2">
            <label class="block mb-1 font-semibold">Student Photo</label>
            <input type="file" name="image"
                   class="w-full border p-2 rounded">
        </div>

    </div>

    <div class="mt-6">
        <button class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
            Save Student
        </button>

        <a href="{{ route('students.index') }}"
           class="ml-4 text-gray-600 dark:text-gray-300">
            Cancel
        </a>
    </div>

</form>

@endsection
