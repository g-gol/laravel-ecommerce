<x-guest-layout>
    <x-form.layout action="{{ route('admin.register') }}">
        <x-form.text-input name="username" label="username"/>
        <x-form.text-input type="email" name="email" label="Enter an email"/>
        <x-form.text-input type="password" name="password" label="Enter a password"/>
        <x-form.text-input type="password" name="password_confirmation" label="Repeat password"/>

        <div class="flex justify-between align-middle items-end">
            <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Submit
            </button>
            <a href="{{ route('login.form') }}" class="underline hover:text-blue-950">Login page</a>
        </div>
    </x-form.layout>
</x-guest-layout>
