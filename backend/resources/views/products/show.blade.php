<x-dashboard.layout>
    <x-slot name="title">{{ $product->name }}</x-slot>

    <div class="flex flex-col h-48 mb-16 space-y-8 mx-auto rounded-sm w-3/4">
        <div class="flex text-3xl justify-between">
            <h1 class="">{{ $product->name }}</h1>
            @can('edit-product')
                <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-600 underline">Edit</a>
            @endcan
        </div>
        <div class="p-2">
            <div class="bg-gray-400 rounded w-1/2 min-h-96"></div>
        </div>
        <div class="flex justify-between">
            <span>Status: {{ $product->status }}</span>
            <span>Price: {{ $product->price }}</span>
        </div>
        <p>{{$product->description}}</p>
        <span>Added by <a href="#" class="text-blue-600 underline">{{ $product->user->username }}</a></span>
    </div>
</x-dashboard.layout>
