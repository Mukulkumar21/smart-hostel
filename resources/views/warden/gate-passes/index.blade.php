@extends('layouts.warden')

@section('content')
<div class="max-w-6xl mx-auto text-gray-800">

    <h1 class="text-2xl font-bold mb-6 text-white">
        Gate Pass Requests
    </h1>

    <div class="bg-white rounded shadow overflow-x-auto">
        <table class="w-full border border-gray-300 text-gray-800">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border">Student</th>
                    <th class="p-2 border">Reason</th>
                    <th class="p-2 border">From</th>
                    <th class="p-2 border">To</th>
                    <th class="p-2 border">Status</th>
                    <th class="p-2 border">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($gatePasses as $pass)
                    <tr class="text-center border-t">
                        <td class="p-2 border">
                            {{ $pass->student->name }}
                        </td>

                        <td class="p-2 border">
                            {{ $pass->reason }}
                        </td>

                        <td class="p-2 border">
                            {{ $pass->from_time }}
                        </td>

                        <td class="p-2 border">
                            {{ $pass->to_time }}
                        </td>

                        <td class="p-2 border font-semibold">
                            @if($pass->status === 'PENDING')
                                <span class="text-yellow-600">PENDING</span>
                            @elseif($pass->status === 'APPROVED')
                                <span class="text-green-600">APPROVED</span>
                            @else
                                <span class="text-red-600">REJECTED</span>
                            @endif
                        </td>

                        <td class="p-2 border">
                            @if($pass->status === 'PENDING')
                                <form method="POST"
                                      action="{{ route('warden.gatepasses.approve', $pass->id) }}"
                                      class="inline">
                                    @csrf
                                    <button class="bg-green-600 text-white px-3 py-1 rounded">
                                        Approve
                                    </button>
                                </form>

                                <form method="POST"
                                      action="{{ route('warden.gatepasses.reject', $pass->id) }}"
                                      class="inline ml-2">
                                    @csrf
                                    <button class="bg-red-600 text-white px-3 py-1 rounded">
                                        Reject
                                    </button>
                                </form>
                            @else
                                —
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-4 text-center text-gray-500">
                            No gate pass requests found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
