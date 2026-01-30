@extends('layouts.app')

@section('content')

<!-- Heading + Add Button -->
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
        Students
    </h1>

    <a href="{{ route('students.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        + Add Student
    </a>
</div>

<!-- Success Message -->
@if(session('success'))
    <div class="bg-green-100 dark:bg-green-900
                text-green-700 dark:text-green-200
                p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<!-- TABLE -->
<x-dark-table>

    <!-- TABLE HEAD -->
    <x-slot name="head">
        <tr>
            <th class="p-3">Name</th>
            <th class="p-3">Email</th>
            <th class="p-3">Phone</th>
            <th class="p-3">Gender</th>
            <th class="p-3">Room</th>
            <th class="p-3">Admission</th>
            <th class="p-3">Parent Phone</th>
            <th class="p-3">Actions</th>
        </tr>
    </x-slot>

    <!-- TABLE BODY -->
    <x-slot name="body">
        @forelse($students as $student)
        <tr class="border-t dark:border-gray-600
                   hover:bg-gray-50 dark:hover:bg-gray-700 transition">

            <td class="p-3 font-semibold">
                {{ $student->name }}
            </td>

            <td class="p-3">
                {{ $student->email }}
            </td>

            <td class="p-3">
                {{ $student->phone ?? '-' }}
            </td>

            <td class="p-3">
                {{ $student->gender ?? '-' }}
            </td>

            <!-- ✅ ROOM (RELATION FIX) -->
            <td class="p-3">
                {{ $student->room?->room_number ?? '-' }}
            </td>

            <!-- ✅ ADMISSION DATE -->
            <td class="p-3">
                {{ $student->admission_date
                    ? \Carbon\Carbon::parse($student->admission_date)->format('d M Y')
                    : '-' }}
            </td>

            <td class="p-3">
                {{ $student->parent_phone ?? '-' }}
            </td>

            <td class="p-3 flex gap-2">
                <a href="{{ route('students.show', $student) }}"
                   class="px-3 py-1 bg-blue-600 text-white rounded">
                    View
                </a>

                <a href="{{ route('students.edit', $student) }}"
                   class="px-3 py-1 bg-yellow-500 text-white rounded">
                    Edit
                </a>

                <form action="{{ route('students.destroy', $student) }}"
                      method="POST"
                      onsubmit="return confirm('Delete this student?')">
                    @csrf
                    @method('DELETE')

                    <button class="px-3 py-1 bg-red-600 text-white rounded">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="8" class="p-4 text-center text-gray-400">
                No students found
            </td>
        </tr>
        @endforelse
    </x-slot>

</x-dark-table>

<!-- PAGINATION -->
<div class="mt-4">
    {{ $students->links() }}
</div>

@endsection
