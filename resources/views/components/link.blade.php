@props(['href'])

<h4 class="text-2xl font-semibold text-primary hover:text-secondary transition">
    <a href="{{ $href }}" class="mb-2">
        {{ $slot }}
    </a>
</h4>
