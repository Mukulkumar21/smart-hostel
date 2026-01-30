@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6 text-gray-900 dark:text-gray-100">
    Edit Student
</h1>

<form action="{{ route('students.update', $student) }}"
      method="POST"
      enctype="multipart/form-data"
      class="bg-white dark:bg-gray-800 p-6 rounded shadow max-w-2xl">

    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <!-- Name -->
        <div>
            <label class="block mb-1">Name</label>
            <input type="text" name="name"
                   value="{{ old('name', $student->name) }}"
                   class="w-full border p-2 rounded" required>
        </div>

        <!-- Email -->
        <div>
            <label class="block mb-1">Email</label>
            <input type="email" name="email"
                   value="{{ old('email', $student->email) }}"
                   class="w-full border p-2 rounded" required>
        </div>

        <!-- Phone -->
        <div>
            <label class="block mb-1">Phone</label>
            <input type="text" name="phone"
                   value="{{ old('phone', $student->phone) }}"
                   class="w-full border p-2 rounded">
        </div>

        <!-- Gender -->
        <div>
            <label class="block mb-1">Gender</label>
            <select name="gender" class="w-full border p-2 rounded">
                <option value="">Select</option>
                <option value="Male"   @selected($student->gender=='Male')>Male</option>
                <option value="Female" @selected($student->gender=='Female')>Female</option>
                <option value="Other"  @selected($student->gender=='Other')>Other</option>
            </select>
        </div>

        <!-- Admission Date -->
        <div>
            <label class="block mb-1">Admission Date</label>
            <input type="date" name="admission_date"
                   value="{{ old('admission_date', $student->admission_date) }}"
                   class="w-full border p-2 rounded">
        </div>

        <!-- Parent Phone -->
        <div>
            <label class="block mb-1">Parent Phone</label>
            <input type="text" name="parent_phone"
                   value="{{ old('parent_phone', $student->parent_phone) }}"
                   class="w-full border p-2 rounded">
        </div>

        <!-- Address -->
        <div class="md:col-span-2">
            <label class="block mb-1">Address</label>
            <textarea name="address"
                      class="w-full border p-2 rounded"
                      rows="3">{{ old('address', $student->address) }}</textarea>
        </div>

        <!-- Photo -->
        <div class="md:col-span-2">
            <label class="block mb-1">Student Photo</label>
            <input type="file" name="image" class="w-full border p-2 rounded">

            @if($student->image)
                <img src="{{ asset('storage/'.$student->image) }}"
                     class="w-20 h-20 mt-2 rounded object-cover">
            @endif
        </div>

        <!-- ✅ Assign Room (AUTO OCCUPANCY) -->
        <div class="md:col-span-2">
            <label class="block mb-1 font-semibold">Assign Room</label>

            <select name="room_id" class="w-full border p-2 rounded">
                <option value="">No Room</option>

                @foreach($rooms as $room)
                    <option value="{{ $room->id }}"
                        @selected($student->room_id == $room->id)
                        @disabled($room->students_count >= $room->capacity && $student->room_id != $room->id)
                    >
                        Room {{ $room->room_number }}
                        ({{ $room->students_count }}/{{ $room->capacity }})
                    </option>
                @endforeach
            </select>
        </div>

    </div>

    <!-- Submit -->
    <div class="mt-6">
        <button class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded">
            Update Student
        </button>
    </div>

</form>

@endsection
