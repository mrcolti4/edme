<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;
    /**
     * @test
     */
    public function it_book_course()
    {
        $user = User::factory()->create();
        $course = Course::factory()->create();
        $response = $this->actingAs($user)->post(route('booking.book', $course));

        $this->assertDatabaseHas('bookings', [
            'user_id' => $user->id,
            'course_id' => $course->id,
        ]);

        $response->assertRedirect(route('booking.success-page'));
    }
}
