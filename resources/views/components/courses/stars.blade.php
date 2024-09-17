@props(['rating'])

<div>
    @for ($i = 1; $i <= 5; $i++)
        @php
            $fillPercentage = min(max(($rating - $i + 1) * 100, 0), 100);
            $fillClass = 'after:w-' . $fillPercentage . 'p';
        @endphp
        <span
            class="relative text-white text-3xl after:font-fontAwesome after:absolute after:top-0 after:left-0 after:content-['\f005']  after:text-secondary after:overflow-hidden fa fa-star {{ $fillClass }}"></span>
    @endfor

</div>
