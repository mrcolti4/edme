@props(['active' => false])

@php
    $classes =
        'relative block w-full text-lg font-semibold text-text transition-all hover:text-secondary hover:after:block after:content-[""] after:absolute after:bottom-2 after:rounded-md after:left-5 after:right-0 after:h-[7px] hover:after:w-6 after:bg-secondary after:transition-all after:duration-300 origin-right py-5 px-5 leading-6';
    if ($active) {
        $classes .= ' text-secondary after:block after:w-6';
    } else {
        $classes .= ' after:w-0';
    }
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
