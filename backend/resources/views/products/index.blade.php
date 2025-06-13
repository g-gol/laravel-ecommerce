<x-dashboard.layout>
    <x-slot name="title">Manage products</x-slot>
    <div class="flex flex-col items-center h-48 mb-4 rounded-sm w-full">
        <x-products.table :products="$products"/>
    </div>
</x-dashboard.layout>
