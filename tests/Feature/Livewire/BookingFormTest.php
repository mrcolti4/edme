<?php

namespace Tests\Feature\Livewire;

use App\Livewire\BookingForm;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class BookingFormTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(BookingForm::class)
            ->assertStatus(200);
    }
}
