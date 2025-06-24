<x-dashboard.layout>
    <x-slot name="title">Edit Category</x-slot>
    <h1 class="text-3xl">Edit {{ $category->name }}</h1>
    <div class="flex flex-col items-center mb-4 rounded-sm w-full">
        <x-form.layout class="w-2/3" :action="route('admin.categories.update', $category)" enctype="multipart/form-data" method="put">
            <x-form.text-input label="Edit a name" name="name" required="true" value="{{ $category->name }}"/>

            <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none
                    focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center
                    dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Update
            </button>
        </x-form.layout>
    </div>
</x-dashboard.layout>
