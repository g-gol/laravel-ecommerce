<x-dashboard.layout>
    <x-slot name="title">Edit user</x-slot>
    <h1 class="text-3xl">Edit {{ $user->username }}</h1>
    <div class="flex flex-col items-center mb-4 rounded-sm w-full">
        <x-form.layout :action="route('admin.users.update', $user)" method="put">
            <x-form.text-input label="username" name="username" :value="$user->username" />
            <x-form.text-input type="email" label="email" name="email" :value="$user->email" />
            @if (!$user->email_verified_at)
                <input class="mb-6" type="checkbox" name="verify" id="verify" />
                <label for="verify">Verify email</label>
            @endif
            <x-form.text-input type="password" label="New Password" name="new-password" />

            <div class="flex flex-col space-y-2 mb-6">
                @foreach ($roles as $role)
                    <div class="w-1/2">
                        <label>
                            <input type="checkbox" name="roles[]" id="roles" value="{{ $role }}"
                                {{ $user->hasRole($role) ? 'checked' : '' }}>
                            {{ $role }}
                        </label>
                    </div>
                @endforeach
            </div>

            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Update
            </button>
        </x-form.layout>
    </div>
</x-dashboard.layout>
