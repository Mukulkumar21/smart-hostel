<x-layouts.app :title="'Edit Student'">
    <div class="max-w-lg mx-auto bg-white shadow-lg rounded-lg p-8">
        <h2 class="text-2xl font-semibold mb-6 text-gray-800">Edit Student</h2>

        <form action="{{ route('students.update', $student->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" value="{{ $student->name }}" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" value="{{ $student->email }}" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">Phone</label>
                <input type="text" name="phone" value="{{ $student->phone }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">Room Number</label>
                <input type="text" name="room_number" value="{{ $student->room_number }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg font-semibold hover:bg-blue-700">
                Update Student
            </button>
        </form>
    </div>
</x-layouts.app>
