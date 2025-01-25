@props(['courses' => [], 'userBookings' => []])


<ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    @foreach ($courses as $item)
        <x-recent-course
            :course="$item"
            :is-pending="isset($userBookings[$item->id]) && $userBookings[$item->id] === \App\Enums\Booking\Status::PENDING->value"
            :is-booked="isset($userBookings[$item->id]) && $userBookings[$item->id] === \App\Enums\Booking\Status::PAID->value"
        />
    @endforeach
</ul>
