<x-dashboard.layout>
    <x-slot name="title">{{ $product->name }}</x-slot>

    <div class="flex flex-col mb-16 space-y-8 mx-auto rounded-sm w-3/4">
        <div class="flex text-3xl justify-between">
            <h1 class="">{{ $product->name }}</h1>
            @can('edit-product')
                <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-600 underline">Edit</a>
            @endcan
        </div>
        <div class="p-2">
            @if($product->image)
                <div class="rounded max-w-1/2">
                    <img src="{{ Storage::url($product->image) }}" alt="main image" class="h-96 object-fill rounded">
                </div>
            @endif
        </div>
        <div class="flex justify-between">
            <span>Status: {{ $product->status }}</span>
            <span>Price: {{ $product->price }}</span>
        </div>
        <p>{{$product->description}}</p>
        <span>Added by <a href="#" class="text-blue-600 underline">{{ $product->user->username }}</a></span>
    </div>
</x-dashboard.layout>
