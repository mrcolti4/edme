<?php

namespace App\DTOs;

use App\Http\Requests\ReviewRequest;

final class ReviewDTO
{
    public function __construct(
        public readonly string $rating,
        public readonly string $comment
    ) {
    }

    public static function getData(ReviewRequest $request)
    {
        return new self(
            rating: $request->validated('rating'),
            comment: $request->validated('comment')
        );
    }
}
