<a {{ $attributes->merge(['class' => 'block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out']) }}>{{ $slot }}</a>
@props(['title', 'value', 'color'])

<div class="bg-gray-800 p-5 rounded shadow border-l-4 border-{{ $color }}-500">
    <p class="text-sm text-gray-400">{{ $title }}</p>
    <p class="text-3xl font-bold text-{{ $color }}-400 mt-2">
        {{ $value }}
    </p>
</div>