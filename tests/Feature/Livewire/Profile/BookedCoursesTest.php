<?php

namespace Tests\Feature\Livewire\Profile;

use App\Enums\Direction;
use App\Enums\FilterBookings;
use App\Livewire\Profile\BookedCourses;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class BookedCoursesTest extends TestCase
{
    use RefreshDatabase;

    /** @var \App\Models\User */
    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = $this->createUser();
        $this->actingAs($this->user);
    }

    /** @test */
    public function renders_successfully()
    {
        Livewire::test(BookedCourses::class)
            ->assertStatus(200);
    }

    /** @test */
    public function can_order_by_filter()
    {
        Livewire::test(BookedCourses::class)
            ->call('orderByFilter', FilterBookings::STATUS)
            ->assertSet('filter', FilterBookings::STATUS);
    }

    /** @test */
    public function can_order_by_direction()
    {
        Livewire::test(BookedCourses::class)
            ->call('orderByDirection', Direction::ASC)
            ->assertSet('order', Direction::ASC);
    }

    private function createUser()
    {
        return User::factory()->create();
    }
}
