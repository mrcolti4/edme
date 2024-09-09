<?php

namespace Tests\Feature\Livewire;

use App\Livewire\BookCourse;
use App\Livewire\BookingForm;
use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class BookingFormTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test that date is in correct range
     *
     * @test
     */
    public function test_date_outside_course_range()
    {
        $course = Course::factory()->create([
            'start_date' => '2022-01-01',
            'end_date' => '2022-01-31',
        ]);
        Livewire::test(BookCourse::class)
            ->set('form.course', $course->id)
            ->set('form.date', '2023-01-01')
            ->call('submit')
            ->assertHasErrors(['form.date' => ['Date is not in the course range']]);
    }

    public function test_date_in_correct_range()
    {
        $course = Course::factory()->create([
            'start_date' => '2022-01-01',
            'end_date' => '2022-01-31',
        ]);
        Livewire::test(BookCourse::class)
            ->set('form.course', $course->id)
            ->set('form.date', '2022-01-10')
            ->call('submit')
            ->assertHasNoErrors('form.date');
    }
}
