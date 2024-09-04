@props(['isOutline' => false])

@php
    $classes =
        'font-bold uppercase bg-primary inline-flex items-center justify-center rounded-3xl px-6 py-3 hover:bg-secondary focus:outline-none focus:bg-secondary transition duration-150 ease-in-out';
    $classes .= $isOutline ? ' text-black hover:text-white border border-gray-300 focus:text-white' : ' text-white';
@endphp

<button {{ $attributes([
    'class' => $classes,
]) }}>
    {{ $slot }}
</button>
