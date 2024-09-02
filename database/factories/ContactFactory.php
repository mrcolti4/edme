<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "phone" => fake()->phoneNumber(),
            "social_links" => json_encode([
                "facebook" => fake()->url(),
                "twitter" => fake()->url(),
                "instagram" => fake()->url(),
                "linkedin" => fake()->url(),
                "telegram" => fake()->url(),
            ]),
            "user_id" => User::factory()
        ];
    }
}
