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
        $rating = 5;
        $comment = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';

        Livewire::actingAs($user)
            ->test('review-form', ['course' => $course])
            ->set('form.rating', $rating)
            ->set('form.comment', $comment)
            ->set('form.course_id', $course->id)
            ->call('store')
            ->assertStatus(200);

        $this->assertDatabaseHas('reviews', [
            'user_id' => $user->id,
            'course_id' => $course->id,
            'rating' => $rating,
            'comment' => $comment
        ]);
    }

    /** @test */
    public function can_update_review_form()
    {
        $user = User::factory()->create();
        $course = Course::factory()->create();
        $review = Review::factory()->create(
            ['user_id' => $user->id, 'course_id' => $course->id]
        );

        $comment = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';

        $this->assertNotEquals($comment, $review->comment);

        Livewire::actingAs($user)
            ->test('review-form', ['course' => $course, 'review' => $review])
            ->assertSet('form.rating', $review->rating)
            ->assertSet('form.comment', $review->comment)
            ->set('form.rating', 3)
            ->set('form.comment', $comment)
            ->call('update')
            ->assertStatus(200);
        
        $this->assertDatabaseHas('reviews', [
            'id' => $review->id,
            'user_id' => $user->id,
            'course_id' => $course->id,
            'rating' => 3,
            'comment' => $comment
        ]);

        $updatedReview = Review::find($review->id);

        $this->assertEquals($comment, $updatedReview->comment);
    }

    /** @test */
    public function can_delete_review_form()
    {
        $user = User::factory()->create();
        $course = Course::factory()->create();
        $review = Review::factory()->create(['user_id' => $user->id, 'course_id' => $course->id]);

        $this->assertDatabaseHas('reviews', [
            'user_id' => $user->id,
            'course_id' => $course->id,
        ]);

        Livewire::actingAs($user)
            ->test('update-review', ['course' => $course, 'review' => $review])
            ->call('deleteReview');

        $this->assertDatabaseMissing('reviews', [
            'user_id' => $user->id,
            'course_id' => $course->id,
        ]);
    }
}

