@props(['textLeft' => false])

<h2 @class([
    'font-extrabold md:text-[55px] md:leading-[65px] text-primary',
    'text-left' => $textLeft,
    'text-center' => !$textLeft,
    $attributes->get('class'),
])>
    {{ $slot }}
</h2>
