<?php

namespace App\Services\Review;

use App\DTOs\ReviewDTO;
use App\Http\Requests\ReviewRequest;
use App\Models\Course;
use App\Models\Review;
use App\Models\User;
use App\Services\Review\ReviewInterface;
use Illuminate\Support\Facades\Redirect;

class ReviewHandler implements ReviewInterface
{
    public function store(ReviewRequest $request, Course $course): void
    {
        $validatedData = ReviewDTO::getData($request);
        $review = Review::updateOrCreate([
            'course_id' => $course->id,
            'user_id' => $request->user()->id,
            'rating' => $validatedData->rating,
            'comment' => $validatedData->comment,
        ]);
    }

    public function update(ReviewRequest $request, Course $course): void
    {
        // TODO: implement update method
    }

    public function destroy(ReviewRequest $request, Course $course): void
    {
        // TODO: implement destroy method
    }
}
