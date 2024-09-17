@props(['teachers'])

<ul class="grid grid-cols-1 md:grid-cols-3">
    @foreach ($teachers as $teacher)
        <x-teacher.show :teacher="$teacher" />
    @endforeach
</ul>
