<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(),
            'description' => fake()->sentence(),
            'price' => fake()->numberBetween(100, 1000),
            'image' => fake()->imageUrl(),
            'students_limit' => fake()->numberBetween(10, 100),
            'start_date' => fake()->dateTimeBetween('now'),
            'end_date' => fake()->dateTimeBetween('now', '+6 month'),
            'teacher_id' => User::factory()->teacher(),
            'category_id' => Category::factory(),
        ];
    }
}
