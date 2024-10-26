<?php

namespace App\Livewire\Forms;

use App\Models\Course;
use App\Models\Review;
use App\Services\Review\ReviewInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ReviewForm extends Form implements ReviewInterface
{
    public ?Review $review;
    public Course $course;

    #[Validate('required|numeric|min:1|max:5')]
    public int $rating;

    #[Validate('required|string|min:50|max:500')]
    public string $comment;

    private function getReviewByUserId(array $data, Course $course): Collection
    {
        return $course->reviews()->where('user_id', Auth::user()->id);
    }

    public function setReview(Review $review)
    {
        $this->review = $review;

        $this->rating = $review->rating;

        $this->comment = $review->comment;

        $this->course = $review->course;
    }

    public function store(array $data): void
    {
        if ($this->getReviewByUserId($data, $this->course)->exists()) {
            // TODO: implement error handling for single review per course from single user;
            return;
        }
    }

    public function update($data): void
    {
        if ($this->review !== null) {
            // TODO: implement error handling if review not found
            return;
        }
        $this->review->update($data);
    }

    public function destroy(): void
    {
        if ($this->review !== null) {
            // TODO: implement error handling if review not found
            return;
        }
        $this->review->delete();
    }
}
