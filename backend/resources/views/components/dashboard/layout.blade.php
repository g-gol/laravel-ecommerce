<x-default-layout>
    <x-slot name="title">{{ $title ?? 'Dashboard' }}</x-slot>
    <x-dashboard.sidebar/>
    <div class="sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg bg-gray-50 min-h-screen">
            {{ $slot }}
        </div>
    </div>
    ]
</x-default-layout>
