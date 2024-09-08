@props(['href'])

<li>
    <a href="{{ $href }}" class="hover:text-secondary transition">
        {{ $slot }}
    </a>
</li>
