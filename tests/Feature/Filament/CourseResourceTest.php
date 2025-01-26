<?php

namespace Tests\Feature\Filament;

use App\Filament\Resources\CourseResource;
use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use Filament\Actions\DeleteAction;
use Filament\Facades\Filament;
use Illuminate\Http\UploadedFile;
use Livewire\Livewire;
use Tests\TestCase;

class CourseResourceTest extends TestCase
{

    /**
     * @test
     */
    public function can_create_course()
    {
        $teacher = User::factory()->teacher()->create();
        $category = Category::factory()->create();
        $file = UploadedFile::fake()->image('avatar.jpg');
        $this->actingAs(User::factory()->create());

        $this->get(CourseResource::getUrl('create'));

        Livewire::test(CourseResource\Pages\CreateCourse::class)
            ->fillForm([
                'name' => 'Filament 101',
                'description' => 'Learn all about Filament',
                'price' => 100,
                'image' => $file,
                'students_limit' => 50,
                'start_date' => '2025-01-01',
                'end_date' => '2026-01-01',
                'teacher_id' => $teacher->id,
                'category_id' => $category->id,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('courses', [
            'name' => 'Filament 101',
            'description' => 'Learn all about Filament',
            'price' => 100,
            'image' => 'course-posters/avatar.jpg',
            'students_limit' => 50,
            'start_date' => '2025-01-01',
            'end_date' => '2026-01-01',
            'teacher_id' => $teacher->id,
            'category_id' => $category->id,
        ]);
    }

    /**
     * @test
     */
    public function can_edit_course()
    {
        $this->actingAs(User::factory()->create());

        $course = Course::factory()->create();

        $this->get(CourseResource::getUrl('edit', ['record' => $course->id]));

        Livewire::test(CourseResource\Pages\EditCourse::class, ['record' => $course->getRouteKey()])
            ->fillForm([
                'name' => 'Filament 101 - Updated',
                'description' => 'Learn all about Filament - Updated',
                'price' => 100
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $course = $course->refresh();
        $this->assertSame('Filament 101 - Updated', $course->name);
        $this->assertSame('Learn all about Filament - Updated', $course->description);
        $this->assertSame(100, $course->price);
    }

    /**
     * @test
     */
    public function can_delete_course()
    {
        $this->actingAs(User::factory()->create());

        $course = Course::factory()->create();

        Livewire::test(CourseResource\Pages\EditCourse::class, ['record' => $course->getRouteKey()])
            ->fillForm([
                'name' => 'Filament 101 - Updated',
                'description' => 'Learn all about Filament - Updated',
                'price' => 100
            ])
            ->callAction(DeleteAction::class);

        $this->assertModelMissing($course);
    }
}
