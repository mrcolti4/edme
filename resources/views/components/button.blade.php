@props(['isOutline' => false, 'tag' => 'button', 'href' => '', 'class' => ''])

@php
    $classes =
        'font-bold uppercase inline-flex items-center justify-center rounded-3xl px-6 py-3 hover:bg-secondary focus:outline-none focus:bg-secondary transition duration-150 ease-in-out ' . $class;
    $classes .= $isOutline
        ? ' text-black hover:text-white border border-gray-300 focus:text-white bg-white'
        : ' text-white bg-primary';
@endphp
@if ($tag === 'a')
    <a {{ $attributes(['class' => $classes]) }} href="{{ $href }}">
        {{ $slot }}
    </a>
@else
    <button {{ $attributes([
        'class' => $classes,
    ]) }}>
        {{ $slot }}
    </button>
@endif
