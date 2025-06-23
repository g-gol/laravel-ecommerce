@props(['products'])
<div class="relative shadow-md sm:rounded-lg w-3/4">
    <div class="flex justify-between">
        <x-table.search/>
        <a href="{{ route('admin.products.create') }}" class="text-blue-600 underline">Create new</a>
    </div>
    <x-table.layout>
        <x-table.thead>
            <x-table.th>
                Name
            </x-table.th>
            <x-table.th>
                Status
            </x-table.th>
            <x-table.th>
                Price
            </x-table.th>
            <x-table.th>
                Amount
            </x-table.th>
            <x-table.th>
                Action
            </x-table.th>
        </x-table.thead>
        <x-table.tbody>
            @foreach ($products as $product)
                <x-table.row>
                    <x-table.td class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap">
                        <a href="{{ route('admin.products.show', $product) }}"
                           class="underline text-base font-semibold">{{ $product->name }}</a>
                    </x-table.td>
                    <x-table.td>
                        {{ $product->status }}
                    </x-table.td>

                    <x-table.td>
                        {{ $product->price }}
                    </x-table.td>

                    <x-table.td>
                        {{ $product->amount }}
                    </x-table.td>

                    <x-table.td>
                        <a href="{{ route('admin.products.edit', $product) }}"
                           class="font-medium text-blue-600 hover:underline">Edit</a>
                    </x-table.td>

                    <x-table.td>
                        @can('delete-product')
                            <form action="{{ route('admin.products.destroy', $product) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="font-medium text-red-600 hover:underline" type="submit">Delete</button>
                            </form>
                        @endcan
                    </x-table.td>
                </x-table.row>
            @endforeach
        </x-table.tbody>
    </x-table.layout>
    <div class="mt-4 px-2">
        {{ $products->links('vendor.pagination.tailwind') }}
    </div>

</div>
