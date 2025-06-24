<x-dashboard.layout>
    <x-slot name="title">Create Product</x-slot>
    <h1 class="text-3xl">Creat new Product</h1>
    <div class="flex flex-col items-center mb-4 rounded-sm w-full">
        <x-form.layout class="w-2/3" :action="route('admin.products.store')" enctype="multipart/form-data">
            <x-form.text-input label="Enter a name" name="name" required="true"/>
            <x-form.textarea label="Enter an excerpt" name="excerpt" required="true"/>
            <x-form.textarea label="Enter a description" name="description" required="true"/>

            <x-form.number label="Amount" name="amount" placeholder="Only number"/>
            <x-form.number label="Product Price" name="price" placeholder="Only number"/>

            <label for="category" class="block mb-2 text-sm font-medium text-gray-900">Category</label>
            <select class="mb-8" id="category_id" name="category_id"
                    class="border text-sm rounded-lg bg-gray-700 p-2 border-gray-600
                        placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ ucfirst($category->name) }}
                    </option>
                @endforeach
            </select>
            <x-form.file label="Upload an image" name="image" help="JPG, PNG"/>

            <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none
                    focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center
                    dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Create
            </button>
        </x-form.layout>
    </div>
</x-dashboard.layout>
