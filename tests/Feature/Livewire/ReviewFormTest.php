<?php

namespace Tests\Feature\Livewire;

use App\Models\Course;
use App\Models\Review;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ReviewFormTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_submit_review_form()
    {
        $user = User::factory()->create();
        $course = Course::factory()->create();
        $review = Review::factory()->make(['user_id' => $user->id, 'course_id' => $course->id]);

        Livewire::actingAs($user)
            ->test('review-form', ['course' => $course, 'review' => $review])
            ->set('rating', 5)
            ->set('comment', $review->comment)
            ->call('store');

        $this->assertDatabaseHas('reviews', [
            'user_id' => $user->id,
            'course_id' => $course->id,
            'rating' => 5,
            'comment' => $review->comment
        ]);
    }

    /** @test */
    public function can_update_review_form()
    {
        $user = User::factory()->create();
        $course = Course::factory()->create();
        $review = Review::factory()->make(['user_id' => $user->id, 'course_id' => $course->id]);

        Livewire::actingAs($user)
            ->test('review-form', ['course' => $course, 'review' => $review])
            ->set('rating', 5)
            ->set('comment', $review->comment)
            ->call('update');

        $this->assertDatabaseHas('reviews', [
            'user_id' => $user->id,
            'course_id' => $course->id,
            'rating' => 5,
            'comment' => $review->comment
        ]);
    }

    public function can_delete_review_form()
    {
        $user = User::factory()->create();
        $course = Course::factory()->create();
        $review = Review::factory()->make(['user_id' => $user->id, 'course_id' => $course->id]);

        Livewire::actingAs($user)
            ->test('review-form', ['course' => $course, 'review' => $review])
            ->call('destroy');

        $this->assertDatabaseMissing('reviews', [
            'user_id' => $user->id,
            'course_id' => $course->id,
        ]);
    }
}

