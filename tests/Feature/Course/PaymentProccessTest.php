<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaymentProccessTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }
    /**
     * @test
     */
    public function test_user_redirected_to_checkout_page()
    {
        $this->mockStripe();
        
        $user = User::factory()->create();
        $course = Course::factory()->create();
        $session = json_decode(file_get_contents('tests/Mock/responses/checkous_session.json'), true);
        
        $response = $this->actingAs($user)
            ->post(route('booking.book', ['course' => $course]), $session);
        
        $this->assertDatabaseHas('bookings', [
            'user_id' => $user->id,
            'course_id' => $course->id,
        ]);

        $response->assertRedirect($session['url']);
    }
}
