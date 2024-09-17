@props(['link'])

<li class="">
    <a href="{{ $link->url }}"
        class="border-secondary border rounded-full hover:bg-secondary transition flex items-center justify-center w-6 h-6">
        <i class="fa-brands fa-{{ $link->name }} text-secondary hover:text-white transition text-sm"></i>
    </a>
</li>
