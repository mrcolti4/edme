<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Course;
use App\Models\Profile;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds
     */
    public function run(): void
    {
        for ($i=1; $i <= 20; $i++) {
        $teacher = User::factory()
            ->has(Profile::factory())
            ->has(Contact::factory())
            ->teacher()
                ->create();

            $course = Course::factory()
                ->recycle($teacher)
                ->create();

            Review::factory()
                ->for($course)
                ->for(User::factory())
                ->create();
        }
    }
}
