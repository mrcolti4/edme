@props(['action' => null, 'method' => 'GET'])

<form action="{{ $action }}" method="{{ $method }}" {{ $attributes }}>
    @csrf
    @if ($method !== 'GET')
        @method($method)
    @endif
    {{ $slot }}
</form>
