@props(['categories'])
<div class="relative shadow-md sm:rounded-lg w-3/4">
    <div class="flex justify-between">
        <x-table.search/>
        <a href="{{ route('admin.categories.create') }}" class="text-blue-600 underline">Create new</a>
    </div>
    <x-table.layout>
        <x-table.thead>
            <x-table.th>
                Name
            </x-table.th>
            <x-table.th>
                Products amount
            </x-table.th>
            <x-table.th>
                Action
            </x-table.th>
        </x-table.thead>
        <x-table.tbody>
            @foreach ($categories as $category)
                <x-table.row>
                    <x-table.td>
                        {{ $category->name }}
                    </x-table.td>
                    <x-table.td>
                        {{ $category->products_count }}
                    </x-table.td>
                    <x-table.td>
                        <a href="{{ route('admin.categories.edit', $category) }}"
                           class="font-medium text-blue-600 hover:underline">Edit</a>
                    </x-table.td>

                    <x-table.td>
                        @can('delete-product')
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="post">
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
    </div>

</div>
