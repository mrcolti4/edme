@props(['courses' => [], 'userBookedCourses' => []])

<ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    @foreach ($courses as $item)
        <x-recent-course :course="$item" :is-booked="in_array($item->id, $userBookedCourses)" />
    @endforeach
</ul>
