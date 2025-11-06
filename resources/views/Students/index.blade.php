@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-10">
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-10">
        <h2 class="text-4xl font-bold text-gray-800 flex items-center gap-2">
            🎓 <span>Student Management</span>
        </h2>
        <a href="{{ route('students.create') }}" 
           class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition duration-300 shadow-md">
            ➕ Add New Student
        </a>
    </div>

    <!-- Flash Message -->
    @if(session('success'))
        <div class="bg-green-100 text-green-800 border border-green-400 px-4 py-3 rounded mb-6 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <!-- Students Table -->
    @if($students->count() > 0)
        <div class="overflow-x-auto bg-white shadow-lg rounded-xl border border-gray-200">
            <table class="min-w-full text-sm text-left">
                <thead class="bg-indigo-600 text-white uppercase text-sm font-semibold">
                    <tr>
                        <th class="px-6 py-3">#</th>
                        <th class="px-6 py-3">Name</th>
                        <th class="px-6 py-3">Email</th>
                        <th class="px-6 py-3">Phone</th>
                        <th class="px-6 py-3">Room</th>
                        <th class="px-6 py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($students as $student)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="px-6 py-3 font-medium text-gray-700">{{ $loop->iteration }}</td>
                        <td class="px-6 py-3">{{ $student->name }}</td>
                        <td class="px-6 py-3">{{ $student->email }}</td>
                        <td class="px-6 py-3">{{ $student->phone ?? '-' }}</td>
                        <td class="px-6 py-3">{{ $student->room_number ?? '-' }}</td>
                        <td class="px-6 py-3 text-center space-x-4">
                            <a href="{{ route('students.edit', $student->id) }}" class="text-blue-600 hover:underline">✏️ Edit</a>
                            <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="inline" 
                                  onsubmit="return confirm('Are you sure you want to delete this student?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">🗑 Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <!-- Empty State Card -->
        <div class="flex flex-col items-center justify-center bg-white p-12 rounded-xl shadow-lg border border-gray-200 max-w-lg mx-auto text-center">
            <div class="text-7xl mb-4 text-indigo-500">📘</div>
            <h3 class="text-2xl text-gray-800 font-semibold mb-2">No Students Found</h3>
            <p class="text-gray-500 mb-6">It looks like there are no students added yet. Add your first student below.</p>
            <a href="{{ route('students.create') }}" 
               class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition duration-300 shadow-md">
                ➕ Add Student
            </a>
        </div>
    @endif
</div>
@endsection
