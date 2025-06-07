<form action="{{ route('admin.logout') }}" method="post"
      class="flex items-baseline p-2 text-gray-50 rounded-lg hover:text-gray-100 group">
    @csrf
    @method('delete')
    <p class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-100 group-hover:cursor-pointer">
        ⏻</p>
    <button type="submit"
            class="ms-3 text-red-400 group-hover:text-gray-100 group-hover:cursor-pointer">
        {{ $slot }}
    </button>
</form>
