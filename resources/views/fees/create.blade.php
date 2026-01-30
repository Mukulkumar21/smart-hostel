@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-4 text-gray-900 dark:text-gray-100">
    Add Fees
</h1>

{{-- Validation Errors --}}
@if($errors->any())
    <div class="bg-red-100 dark:bg-red-900
                text-red-700 dark:text-red-200
                p-3 rounded mb-4">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form method="POST"
      action="{{ route('fees.store') }}"
      class="bg-white dark:bg-gray-800
             p-6 rounded shadow max-w-md">

    @csrf

    {{-- Student --}}
    <div class="mb-4">
        <label class="block mb-1 font-semibold">
            Student
        </label>
        <select name="student_id"
                class="w-full border p-2 rounded" required>
            <option value="">-- Select Student --</option>
            @foreach($students as $student)
                <option value="{{ $student->id }}">
                    {{ $student->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Total Fees --}}
    <div class="mb-4">
        <label class="block mb-1 font-semibold">
            Total Fees
        </label>
        <input type="number"
               name="total_fees"
               class="w-full border p-2 rounded"
               placeholder="e.g. 5000"
               required>
    </div>

    {{-- Paid Fees --}}
    <div class="mb-4">
        <label class="block mb-1 font-semibold">
            Paid Fees
        </label>
        <input type="number"
               name="paid_fees"
               class="w-full border p-2 rounded"
               placeholder="e.g. 2000"
               required>
    </div>

    {{-- Info --}}
    <p class="text-sm text-gray-500 mb-4">
        Pending fees and status will be calculated automatically.
    </p>

    {{-- Submit --}}
    <button class="bg-blue-600 hover:bg-blue-700
                   text-white px-4 py-2 rounded">
        Save Fees
    </button>

    <a href="{{ route('fees.index') }}"
       class="ml-3 text-gray-600 hover:underline">
        Cancel
    </a>

</form>

@endsection
