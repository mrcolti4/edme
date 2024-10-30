<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Course;
use App\Models\Profile;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds
     */
    public function run(): void
    {
        $categories = Category::factory()
            ->count(4)
            ->onHomepage()
            ->create();

        for ($i = 1; $i <= 15; $i++) {
            $teacher = User::factory()
                ->has(Profile::factory())
                ->has(Contact::factory())
                ->teacher()
                ->create();

            $user = User::factory()
                ->has(Profile::factory())
                ->has(Contact::factory())
                ->create();

            $course = Course::factory()
                ->recycle($categories->random())
                ->recycle($teacher)
                ->create();

            Review::factory()
                ->recycle($course)
                ->recycle($user)
                ->count(1)
                ->create();
        }
    }
}
