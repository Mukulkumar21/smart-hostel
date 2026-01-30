@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-4 text-gray-900 dark:text-gray-100">
    Edit Fees
</h1>

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
      action="{{ route('fees.update', $fee->id) }}"
      class="bg-white dark:bg-gray-800
             p-6 rounded shadow max-w-md">

    @csrf
    @method('PUT')

    {{-- Student --}}
    <div class="mb-4">
        <label class="block mb-1 font-semibold">
            Student
        </label>
        <select name="student_id"
                class="w-full border p-2 rounded">
            @foreach($students as $student)
                <option value="{{ $student->id }}"
                    {{ $fee->student_id == $student->id ? 'selected' : '' }}>
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
               value="{{ $fee->total_fees }}"
               class="w-full border p-2 rounded">
    </div>

    {{-- Paid Fees --}}
    <div class="mb-4">
        <label class="block mb-1 font-semibold">
            Paid Fees
        </label>
        <input type="number"
               name="paid_fees"
               value="{{ $fee->paid_fees }}"
               class="w-full border p-2 rounded">
    </div>

    <p class="text-sm text-gray-500 mb-4">
        Pending fees & status will update automatically.
    </p>

    <button class="bg-green-600 hover:bg-green-700
                   text-white px-4 py-2 rounded">
        Update Fees
    </button>

    <a href="{{ route('fees.index') }}"
       class="ml-3 text-gray-600 hover:underline">
        Cancel
    </a>

</form>

@endsection
