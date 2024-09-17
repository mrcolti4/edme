@props(['links' => []])

<ul class="flex gap-4 self-center">
    @foreach ($links as $link)
        <x-teacher.links.show :link="$link" />
    @endforeach
</ul>
