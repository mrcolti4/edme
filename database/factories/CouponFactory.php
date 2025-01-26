<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupon>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'stripe_id' => 'cup_' . fake()->uuid(),
            'name' => fake()->unique()->word(),
            'percent_off' => fake()->numberBetween(1, 100),
            'max_redemptions' => fake()->numberBetween(1, 10),
        ];
    }
}
