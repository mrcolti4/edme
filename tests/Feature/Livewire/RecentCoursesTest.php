<?php

namespace Tests\Feature\Livewire;

use App\Livewire\RecentCourses;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class RecentCoursesTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(RecentCourses::class)
            ->assertStatus(200);
    }
}
