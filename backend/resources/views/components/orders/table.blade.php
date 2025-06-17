@props(['orders'])
<div class="relative shadow-md sm:rounded-lg w-3/4">
    <div class="flex justify-between">
        <x-table.search/>
    </div>
    <x-table.layout>
        <x-table.thead>
            <x-table.th>
                Order ID
            </x-table.th>
            <x-table.th>
                Status
            </x-table.th>
            <x-table.th>
                Total Price
            </x-table.th>
            <x-table.th>
                Ordered By
            </x-table.th>
            <x-table.th>
                Action
            </x-table.th>
        </x-table.thead>
        <x-table.tbody>
            @foreach ($orders as $order)
                <x-table.row>
                    <x-table.td class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap">
                        <a href="{{ route('admin.orders.show', $order) }}"
                           class="text-blue-600 underline">
                            {{ $order->id }}
                        </a>
                    </x-table.td>
                    <x-table.td>
                        {{ $order->status }}
                    </x-table.td>

                    <x-table.td>
                        {{ $order->total }}
                    </x-table.td>

                    <x-table.td>
                        {{ $order->user->username }}
                    </x-table.td>

                    <x-table.td>
                        <a href="{{ route('admin.orders.edit', $order) }}"
                           class="font-medium text-blue-600 hover:underline">Edit</a>
                    </x-table.td>

                    <x-table.td>
                        @if(!in_array($order->status, ['cancelled', 'delivered']))
                            <form action="{{ route('admin.orders.cancel', $order) }}" method="post">
                                @csrf
                                @method('patch')
                                <button class="font-medium text-red-600 hover:underline" type="submit">Cancel</button>
                            </form>
                        @endif
                    </x-table.td>
                </x-table.row>
            @endforeach
        </x-table.tbody>
    </x-table.layout>
    <div class="mt-4 px-2">
        {{ $orders->links('vendor.pagination.tailwind') }}
    </div>

</div>
