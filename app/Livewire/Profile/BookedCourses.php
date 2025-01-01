<?php

namespace App\Livewire\Profile;

use App\Enums\Direction;
use App\Enums\FilterBookings;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class BookedCourses extends Component
{
    public FilterBookings $filter = FilterBookings::CREATED_AT;
    public Direction $order = Direction::ASC;
    public Collection $bookings;

    public function mount()
    {
        $this->updateBookings();
    }
    public function render()
    {
        return view('livewire.profile.booked-courses', [
            'bookings' => $this->bookings
        ]);
    }

    public function orderByFilter(FilterBookings $filter)
    {
        $this->filter = $filter;
        $this->updateBookings();
    }

    public function orderByDirection(Direction $direction)
    {
        $this->order = $direction;
        $this->updateBookings();
    }

    private function updateBookings()
    {
        $this->bookings = auth()->user()
            ->bookings()
            ->with('course')
            ->orderBy(
                $this->filter->value,
                $this->order->value
            )
            ->get();
    }
}
