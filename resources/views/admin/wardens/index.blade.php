@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-10 bg-gray-900 text-gray-100 p-6 rounded shadow">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Wardens List</h2>

        <a href="{{ route('admin.wardens.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Create Warden
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-800 text-green-100 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full border border-gray-700 rounded overflow-hidden">
            <thead class="bg-gray-800 text-gray-200">
                <tr>
                    <th class="border border-gray-700 px-4 py-3 text-left">#</th>
                    <th class="border border-gray-700 px-4 py-3 text-left">Name</th>
                    <th class="border border-gray-700 px-4 py-3 text-left">Email</th>
                    <th class="border border-gray-700 px-4 py-3 text-left">Created At</th>
                </tr>
            </thead>

            <tbody>
                @forelse($wardens as $warden)
                    <tr class="hover:bg-gray-800">
                        <td class="border border-gray-700 px-4 py-2">
                            {{ $loop->iteration }}
                        </td>
                        <td class="border border-gray-700 px-4 py-2">
                            {{ $warden->name }}
                        </td>
                        <td class="border border-gray-700 px-4 py-2">
                            {{ $warden->email }}
                        </td>
                        <td class="border border-gray-700 px-4 py-2">
                            {{ $warden->created_at->format('d M Y') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4"
                            class="border border-gray-700 px-4 py-6 text-center text-gray-400">
                            No wardens found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection