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
        $socialPlatforms = ["twitter", "instagram", "facebook", "linkedin", "dribbble", "github"];
        $socialLinks = array_map(function ($platform) {
            return [
                "name" => $platform,
                "url" => "https://{$platform}.com/" . $this->faker->userName(),
            ];
        }, $socialPlatforms);
        return [
            "phone" => fake()->phoneNumber(),
            "social_links" => json_encode($socialLinks),
            "user_id" => User::factory()
        ];
    }
}
