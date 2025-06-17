<x-dashboard.layout>
    <x-slot name="title">Edit Order</x-slot>
    <h1 class="text-3xl">Edit Order #{{ $order->id }}</h1>
    <div class="flex flex-col items-center mb-4 rounded-sm w-full">
        <x-form.layout class="w-2/3" :action="route('admin.orders.update', $order)" method="put">
            <x-form.text-input label="Edit a shipping address" name="shipping_address" required="true" value="{{ $order->shipping_address }}"/>

            <div class="mb-6">
                <label for="countries" class="block mb-2 text-sm font-medium text-gray-900" >Change a
                    status</label>
                <select id="countries"
                        name="status"
                        class="border text-sm rounded-lg bg-gray-700 p-2 border-gray-600
                        placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                    @foreach($statuses as $status)
                        <option value="{{ $status }}" {{ $status === $order->status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none
                    focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center
                    dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Update
            </button>
        </x-form.layout>
    </div>
</x-dashboard.layout>
