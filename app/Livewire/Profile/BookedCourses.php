<?php

namespace App\Livewire\Profile;

use App\Enums\Direction;
use App\Enums\FilterBookings;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class BookedCourses extends Component
{
    use WithPagination;
    
    public FilterBookings $filter = FilterBookings::CREATED_AT;
    public Direction $order = Direction::ASC;

    public function render()
    {
        return view('livewire.profile.booked-courses', [
            'bookings' => auth()->user()
            ->bookings()
            ->with('course')
            ->orderBy(
                $this->filter->value,
                $this->order->value
            )
            ->simplePaginate(5)
        ]);
    }
}
