@props(['rating'])

<div class="stars">
    @for ($i = 1; $i <= 5; $i++)
        <span
            class="relative text-white text-3xl after:font-fontAwesome after:absolute after:top-0 after:left-0 after:content-['\f005']  after:text-secondary after:overflow-hidden fa fa-star"></span>
    @endfor

</div>
