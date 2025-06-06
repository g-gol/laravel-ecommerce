@props(['action', 'method' => 'post'])
<form action="{{ $action }}" method="{{ $method === 'get' ? 'get' : 'post' }}" class="py-8 px-16 rounded-2xl bg-neutral-100">
    @csrf
    @if(! in_array($method, ['post', 'get']))
        @method($method)
    @endif
    {{ $slot }}
</form>
