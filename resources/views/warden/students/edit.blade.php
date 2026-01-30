@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto bg-white dark:bg-gray-900 p-6 rounded shadow">

    <h2 class="text-2xl font-bold mb-6">
        Edit Student Profile
    </h2>

    <form method="POST"
          action="{{ route('warden.students.update', $student) }}"
          enctype="multipart/form-data"
          class="space-y-4">

        @csrf
        @method('PUT')

        {{-- Name --}}
        <div>
            <label class="block mb-1">Name</label>
            <input type="text"
                   name="name"
                   value="{{ old('name', $student->name) }}"
                   class="w-full border p-2 rounded">
        </div>

        {{-- Email --}}
        <div>
            <label class="block mb-1">Email</label>
            <input type="email"
                   name="email"
                   value="{{ old('email', $student->email) }}"
                   class="w-full border p-2 rounded">
        </div>

        {{-- Phone --}}
        <div>
            <label class="block mb-1">Phone</label>
            <input type="text"
                   name="phone"
                   value="{{ old('phone', $student->phone) }}"
                   class="w-full border p-2 rounded">
        </div>

        {{-- Gender --}}
        <div>
            <label class="block mb-1">Gender</label>
            <select name="gender" class="w-full border p-2 rounded">
                <option value="">Select</option>
                <option value="male" {{ $student->gender == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ $student->gender == 'female' ? 'selected' : '' }}>Female</option>
            </select>
        </div>

        {{-- Room --}}
        <div>
            <label class="block mb-1">Room</label>
            <select name="room_id" class="w-full border p-2 rounded">
                <option value="">Not Assigned</option>
                @foreach($rooms as $room)
                    <option value="{{ $room->id }}"
                        {{ $student->room_id == $room->id ? 'selected' : '' }}>
                        {{ $room->room_number }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Photo --}}
        <div>
            <label class="block mb-1">Photo</label>
            <input type="file" name="photo">
        </div>

        {{-- Buttons --}}
        <div class="flex gap-3 mt-6">
            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Update
            </button>

            <a href="{{ route('warden.students.show', $student) }}"
               class="px-4 py-2 border rounded">
                Cancel
            </a>
        </div>

    </form>
</div>

@endsection