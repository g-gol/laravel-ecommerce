<x-dashboard.layout>
    <x-slot name="title">Create Product</x-slot>
    <h1 class="text-3xl">Creat new Product</h1>
    <div class="flex flex-col items-center h-48 mb-4 rounded-sm w-full">
        <x-form.layout class="w-2/3" :action="route('admin.products.create')">
            <x-form.text-input label="Enter a name" name="name" required="true"/>
            <x-form.textarea label="Enter an excerpt" name="excerpt" required="true"/>
            <x-form.textarea label="Enter a description" name="description" required="true"/>

            <x-form.number label="Product Price" name="price" placeholder="Only number"/>
            <x-form.file label="Upload an image" name="image" help="JPG, PNG"/>

            <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none
                    focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center
                    dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Update
            </button>
        </x-form.layout>
    </div>
</x-dashboard.layout>
