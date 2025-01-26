<?php

namespace App\Livewire\Forms;

use App\Models\Review;
use App\Services\Review\ReviewInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ReviewForm extends Form implements ReviewInterface
{
    public ?Review $review;

    #[Validate('required|numeric|min:1|max:5')]
    public ?int $rating;

    #[Validate('required|string|min:50|max:500')]
    public ?string $comment;

    #[Validate('required|exists:courses,id')]
    public ?int $course_id;

    public function getReviewByUserId()
    {
        return Review::where('course_id', $this->course_id)
            ->where('user_id', Auth::user()->id);    }

    public function setReview(Review $review)
    {
        $this->review = $review;

        $this->rating = $review->rating;

        $this->comment = $review->comment;
    }

    public function store(): ?RedirectResponse
    {
        $this->validate();

        if ($this->getReviewByUserId()->exists()) {
            return redirect()->back()->with("error", "You have already submitted a review for this course");
        }
        
        Review::updateOrCreate([
            'course_id' => $this->course_id,
            'user_id' => auth()->user()->id,
            'rating' => $this->rating,
            'comment' => $this->comment,
        ]);
        return null;
    }

    public function update(): ?RedirectResponse
    {
        if ($this->review === null) {
            return redirect()->back()->with("error", "Review not found");
        }
        $this->review->update($this->only(['rating', 'comment']));

        return null;
    }

    public function destroy(): ?RedirectResponse
    {
        if ($this->review === null) {
            return redirect()->back()->with("error", "Review not found");
        }
        $this->review->delete();

        return null;
    }
}
