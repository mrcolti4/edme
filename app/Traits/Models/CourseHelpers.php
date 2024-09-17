<?php

namespace App\Traits\Models;

use Carbon\Carbon;

trait CourseHelpers
{
    private function getAvgRating(): float
    {
        $reviews = $this->reviews()->get();
        $sum = 0;
        foreach ($reviews as $review) {
            $sum += $review->rating;
        }

        return $sum === 0 ? 0 : $sum / $reviews->count();
    }
    public function avgRating(): float
    {
        return $this->getAvgRating();
    }

    public function studentsLeft(): int
    {
        return $this->students_limit - $this->bookings()->where("is_verified", 1)->count();
    }

    public function courseDuration()
    {
        $start_date = date_create($this->start_date);
        $end_date = date_create($this->end_date);

        return date_diff($start_date, $end_date)->format("%a days");
    }

    public function getCourseDates()
    {
        return Carbon::parse($this->start_date)->format('M d, Y') . " - " . Carbon::parse($this->end_date)->format('M d, Y');
    }
}
