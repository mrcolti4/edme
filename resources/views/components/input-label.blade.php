@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-semibold']) }}>
    {{ $value ?? $slot }}
</label>
