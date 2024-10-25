<?php

namespace App\Http\Controllers;

use App\Services\Review\ReviewHandler;
use Illuminate\Http\Request;

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
