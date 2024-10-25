<?php

namespace App\Services\Review;

use App\Http\Requests\ReviewRequest;
use App\Models\Course;

interface ReviewInterface
{
    public function store(ReviewRequest $request, Course $course): void;

    public function update(ReviewRequest $request, Course $course): void;

    public function destroy(ReviewRequest $request, Course $course): void;
}
