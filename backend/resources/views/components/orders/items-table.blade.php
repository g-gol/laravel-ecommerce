@props(['items'])
<x-table.layout>
    <x-table.thead>
        <tr>
            <x-table.th>
                Name
            </x-table.th>
            <x-table.th>
                Amount
            </x-table.th>
            <x-table.th>
                Price
            </x-table.th>
            <x-table.th>
                Action
            </x-table.th>
        </tr>
    </x-table.thead>
    <x-table.tbody>
        @foreach($items as $item)
            <form action="{{ route('admin.orders.items.update', $item) }}" method="post">
                @csrf
                @method('put')
                <tr x-data="{ editMode: false, quantity: {{ $item->quantity }} }">
                    <x-table.td>
                        {{ $item->product->name }}
                    </x-table.td>
                    <x-table.td>
                        <div x-show="!editMode" class="font-bold h-8 p-1">{{ $item->quantity }}</div>

                        <div x-show="editMode" class="relative flex items-center max-w-[4rem]">
                            <button x-on:click.prevent="if (quantity > 1) quantity--" type="button" id="decrement-button"
                                    class="bg-gray-100 hover:bg-gray-200 border border-gray-300 rounded p-1 h-8
                                focus:ring-gray-100 focus:ring-2 focus:outline-none">
                                -
                            </button>
                            <input type="text" id="quantity-input" name="quantity" inputmode="numeric"
                                   @input="quantity= $event.target.value.replace(/[^0-9]/g, '')"
                                   class="bg-gray-50 border-x-0 border-gray-300 h-8 text-center text-gray-900
                               text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2"
                                   placeholder="999" x-model="quantity" required/>
                            <button x-on:click.prevent="quantity++" type="button" id="increment-button"
                                    class="bg-gray-100 hover:bg-gray-200 border border-gray-300 rounded p-1 h-8
                                focus:ring-gray-100 focus:ring-2 focus:outline-none">
                                +
                            </button>
                        </div>
                    </x-table.td>
                    <x-table.td>
                        <div x-show="!editMode" class="font-bold h-8 p-1">{{  $item->price }}</div>
                        <div x-show="editMode" class="relative flex items-center max-w-[4rem]">
                            <input type="text" id="quantity-input" name="price"
                                   class="bg-gray-50 border-x-0 border-gray-600 h-8 text-center
                               text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500
                               block w-full py-2"
                                   placeholder="999" value="{{ $item->price }}" required/>
                        </div>
                    </x-table.td>
                    <x-table.td>
                        <button x-show="!editMode" x-on:click.prevent="editMode=true" class="text-blue-600 cursor-pointer">Edit
                        </button>
                        <button type="submit" x-show="editMode" class="text-blue-600 cursor-pointer">Save</button>
                    </x-table.td>
                    <x-table.td>
                        <button x-show="editMode" x-on:click.prevent="editMode=false" class="text-red-500 cursor-pointer">Cancel
                        </button>
                    </x-table.td>
                </tr>
            </form>
        @endforeach
    </x-table.tbody>
</x-table.layout>
