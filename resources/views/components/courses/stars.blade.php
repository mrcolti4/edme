@props(['rating'])

<div class="stars">
    @for ($i = 0; $i < 5; $i++)
        @php
            $width = min(max(($rating - $i) * 100, 0), 100);
        @endphp
        <x-courses.star :width="$width"/>
    @endfor
</div>
