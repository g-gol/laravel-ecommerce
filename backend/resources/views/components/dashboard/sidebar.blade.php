<aside id="default-sidebar"
       class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
       aria-label="Sidebar">
    <div class="flex flex-col justify-between h-full px-3 py-4 overflow-y-auto text-gray-100 bg-gray-800">
        <ul class="space-y-2 font-medium">
            <x-dashboard.sidebar-link :to="route('admin.home')">Dashboard</x-dashboard.sidebar-link>
            @can('edit-user')
                <x-dashboard.sidebar-link :to="route('admin.users.index')" emoji="👨‍👨‍👦">Users</x-dashboard.sidebar-link>
            @endcan
            @can('edit-product')
                <x-dashboard.sidebar-link :to="route('admin.products.index')" emoji="🍟">Products</x-dashboard.sidebar-link>
            @endcan
            @can('edit-product')
                <x-dashboard.sidebar-link :to="route('admin.orders.index')" emoji="⚡">Orders</x-dashboard.sidebar-link>
            @endcan
        </ul>
        <ul class="space-y-2 font-medium mb-4">
            <x-dashboard.sidebar-link>Hi, {{ auth()->user()->username }}</x-dashboard.sidebar-link>
            <li>
                <x-form.logout-button>Logout</x-form.logout-button>
            </li>

        </ul>

    </div>
</aside>
