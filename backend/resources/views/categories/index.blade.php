<x-dashboard.layout>
    <x-slot name="title">Manage categories</x-slot>
    <div class="flex flex-col items-center mb-4 rounded-sm w-full">
        <x-categories.table :categories="$categories"/>
    </div>
</x-dashboard.layout>
