<?php

namespace Tests\Feature\Livewire;

use App\Livewire\TestimonialSlide;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class TestimonialSlideTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(TestimonialSlide::class)
            ->assertStatus(200);
    }
}
