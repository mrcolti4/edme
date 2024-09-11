<?php

namespace Tests\Feature\Livewire;

use App\Livewire\TeachersList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class TeachersListTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(TeachersList::class)
            ->assertStatus(200);
    }
}
