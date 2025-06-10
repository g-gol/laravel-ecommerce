@props(['to' => '#','emoji' => '🏢'])
<li>
    <a href="{{ $to }}"
       class="flex items-baseline p-2 text-gray-50 rounded-lg hover:text-gray-100 group">
        <p class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-100">
            {{ $emoji }}
        </p>
        <span class="ms-3">
            {{ $slot }}
        </span>
    </a>
</li>
