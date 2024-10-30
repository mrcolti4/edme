@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-semibold flex flex-col gap-2']) }}>
    {{ $value ?? $slot }}
</label>
