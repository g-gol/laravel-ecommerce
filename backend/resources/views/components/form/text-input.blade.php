@props(['label', 'type' => 'text', 'name', 'placeholder'])
<div class="mb-6">
    <label for="{{ $name }}" class="block mb-2 text-sm font-medium text-gray-900">{{ ucfirst($label) }}</label>
    <input type="{{ $type }}" id="{{ $name }}"
           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
           name="{{ $name }}"
           placeholder="{{ $placeholder ?? ucfirst($label) }}" required/>
</div>
