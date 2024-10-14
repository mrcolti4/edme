@props(['rating'])

<div class="stars">
    @for ($i = 0; $i < 5; $i++)
        @php
            $width = min(max(($rating - $i) * 100, 0), 100);
        @endphp
        <span
            class="relative text-gray-300 text-xs after:font-fontAwesome after:absolute after:top-0 after:left-0 after:content-['\f005']  after:text-yellow-400 after:overflow-hidden fa fa-star"
            style="--width: {{$width}}%">
        </span>
    @endfor
</div>
