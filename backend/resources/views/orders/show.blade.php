<x-dashboard.layout>
    <x-slot name="title">Order</x-slot>

    <div class="flex flex-col mb-16 space-y-8 mx-auto rounded-sm w-3/4">
        <div class="flex text-3xl justify-between">
            <h1 class="">Order #{{ $order->id }}</h1>
            @can('edit-order')
                <a href="{{ route('admin.orders.edit', $order) }}" class="text-blue-600 underline">Edit</a>
            @endcan
        </div>

        <h2 class="text-xl">Ordered products:</h2>
        <x-orders.items-table :items="$items" />

        <h2 class="text-xl">Total price: {{ $order->total }}</h2>
        <h2 class="text-xl">Status: {{ $order->status }}</h2>
        <h2 class="text-xl">Address: {{ $order->shipping_address }}</h2>


    </div>
</x-dashboard.layout>
