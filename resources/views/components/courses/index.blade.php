@props(['courses' => []])

<ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    @foreach ($courses as $item)
        <x-recent-course :course="$item" />
    @endforeach
</ul>
