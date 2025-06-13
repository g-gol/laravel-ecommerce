<x-dashboard.layout>
    <x-slot name="title">Manage users</x-slot>
    <div class="flex flex-col items-center h-48 mb-4 rounded-sm w-full">
        <x-users.table :users="$users"/>
    </div>
</x-dashboard.layout>
