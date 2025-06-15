@props(['action', 'method' => 'post', 'enctype' => 'application/x-www-form-urlencoded'])
<form action="{{ $action }}" method="{{ $method === 'get' ? 'get' : 'post' }}"
    {{ $attributes->merge(['class' => 'py-8 px-16 rounded-2xl bg-neutral-100']) }}
    enctype="{{ $enctype }}"
>
    @csrf
    @if(! in_array($method, ['post', 'get']))
        @method($method)
    @endif
    {{ $slot }}
</form>
