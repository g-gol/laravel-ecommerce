<x-dashboard.layout>
    <x-slot name="title">Manage orders</x-slot>
    <div class="flex flex-col items-center mb-4 rounded-sm w-full">
        <x-orders.table :orders="$orders" />
    </div>
</x-dashboard.layout>
