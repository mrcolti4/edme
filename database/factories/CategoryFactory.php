<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->realText(20),
            'slug' => fake()->slug(),
            'description' => fake()->realTextBetween(100, 200),
            'image' => fake()->imageUrl(),
        ];
    }
    public function onHomepage()
    {
        return $this->state(fn(array $attributes) => [
            'on_homepage' => true,
        ]);
    }
}
