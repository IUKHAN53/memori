<?php

namespace Database\Factories;

use App\Models\Profile;
use App\Models\ProfileTributes;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProfileTributes>
 */
class ProfileTributesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'profile_id' => Profile::factory(),
            'user_id' => User::factory(),
            'title' => fake()->sentence(4),
            'tribute' => fake()->paragraphs(fake()->numberBetween(1, 4), true),
            'likes' => fake()->numberBetween(0, 50),
        ];
    }

    /**
     * Indicate that the tribute belongs to a specific profile.
     */
    public function forProfile(Profile $profile): static
    {
        return $this->state(fn (array $attributes) => [
            'profile_id' => $profile->id,
        ]);
    }

    /**
     * Indicate that the tribute was written by a specific user.
     */
    public function writtenBy(User $user): static
    {
        return $this->state(fn (array $attributes) => [
            'user_id' => $user->id,
        ]);
    }
}
