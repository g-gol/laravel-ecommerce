@props(['users'])
<div class="relative shadow-md sm:rounded-lg w-3/4">
<x-table.search />
    <x-table.layout>
        <x-table.thead>
            <x-table.th>
                Name
            </x-table.th>
            <x-table.th>
                Role
            </x-table.th>
            <x-table.th>
                Email verified
            </x-table.th>
            <x-table.th>
                Action
            </x-table.th>
        </x-table.thead>
        <x-table.tbody>
            @foreach ($users as $user)
                <x-table.row>
                    <x-table.td class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap">
                        <div class="ps-3">
                            <div class="text-base font-semibold">{{ $user->username }}</div>
                            <div class="font-normal text-gray-500">{{ $user->email }}</div>
                        </div>
                    </x-table.td>
                    <x-table.td>
                        {{ $user->roles->pluck('name')->implode(', ') }}
                    </x-table.td>

                    <x-table.td>
                        <div class="flex items-center">
                            <div
                                class="h-2.5 w-2.5 rounded-full me-2 {{ $user->email_verified_at ? 'bg-green-500' : 'bg-red-400' }}">
                            </div>
                            {{ $user->email_verified_at ?? 'Not verified' }}
                        </div>
                    </x-table.td>

                    <x-table.td>
                        <a href="{{ route('admin.users.edit', $user) }}"
                           class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit user</a>
                    </x-table.td>

                    <x-table.td>
                        @if($user->id !== auth()->id())
                            <form action="{{ route('admin.users.delete', $user) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="font-medium text-red-600 hover:underline" type="submit">Delete</button>
                            </form>
                        @else
                            <span>You</span>
                        @endif
                    </x-table.td>
                </x-table.row>
            @endforeach
        </x-table.tbody>
    </x-table.layout>
    {{ $users->links() }}
</div>
