<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Course;
use App\Services\Review\ReviewHandler;

class ReviewController extends Controller
{
    public function __construct(public ReviewHandler $reviewHandler)
    {
    }

    public function store(ReviewRequest $request, Course $course)
    {
        $this->reviewHandler->store($request, $course);
    }

    public function update(ReviewRequest $request, Course $course)
    {
        $this->reviewHandler->update($request, $course);
    }

    public function destroy(ReviewRequest $request, Course $course)
    {
        $this->reviewHandler->destroy($request, $course);
    }
}
