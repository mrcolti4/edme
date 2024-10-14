<?php

namespace App\Traits\Models;

use Carbon\Carbon;

trait CourseHelpers
{
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
