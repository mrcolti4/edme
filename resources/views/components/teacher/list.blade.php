@props(['teachers'])

<ul class="grid grid-cols-1 md:grid-cols-3 gap-5">
    @foreach ($teachers as $teacher)
        <x-teacher.show :teacher="$teacher" />
    @endforeach
</ul>
