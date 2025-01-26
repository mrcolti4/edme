<?php

namespace Database\Factories;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PromotionCode>
 */
class PromotionCodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'stripe_id' => 'promo_test',
            'coupon_id' => Coupon::factory(),
            'code' => fake()->word(),
            'expires_at' => fake()->dateTimeBetween('-1 year', '+1 year')->getTimestamp(),
            'max_redemptions' => fake()->numberBetween(1, 10),
            'is_active' => true,
        ];
    }
}
