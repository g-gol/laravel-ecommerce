@props(['label', 'name', 'help' => ''])
<div class="mb-6">
    <label class="block mb-2 text-sm font-medium text-gray-900 " for="{{ $name }}">
        {{ $label }}
    </label>
    <input class="block w-full p-2 text-sm border rounded-lg cursor-pointer
            text-gray-100 focus:outline-none bg-gray-700 border-gray-600
            placeholder-gray-400" aria-describedby="file_input_help" id="{{ $name }}" type="file"
           name="{{ $name }}">

    <p class="mt-1 text-sm text-gray-500" id="file_input_help">
        {{ $help }}
    </p>
</div>
