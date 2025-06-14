@props(['label', 'name', 'placeholder', 'required' => false, 'value' => ''])
<div class="mb-6">
    <label for="{{ $name }}" class="mb-2 text-sm font-medium text-gray-900">
        Price
    </label>
    <input type="number" name="{{ $name }}" id="{{ $name }}"
           class="block p-2.5 w-full z-20 ps-10 text-sm rounded-s-lg
                       bg-gray-700 border-e-gray-700
                       border-gray-600 placeholder-gray-400 text-white
                       focus:border-blue-500"
           placeholder="{{ $placeholder ?? ucfirst($name) }}"
           {{ $required ? 'required' : '' }}/>
</div>
