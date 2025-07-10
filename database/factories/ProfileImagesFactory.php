<?php

namespace Database\Factories;

use App\Models\Profile;
use App\Models\ProfileImages;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProfileImages>
 */
class ProfileImagesFactory extends Factory
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
            'path' => 'profile-images/' . fake()->uuid() . '.jpg',
            'caption' => fake()->optional(0.8)->sentence(),
        ];
    }

    /**
     * Indicate that the photo was uploaded by a specific user.
     */
    public function uploadedBy(User $user): static
    {
        return $this->state(fn (array $attributes) => [
            'user_id' => $user->id,
        ]);
    }

    /**
     * Indicate that the photo belongs to a specific profile.
     */
    public function forProfile(Profile $profile): static
    {
        return $this->state(fn (array $attributes) => [
            'profile_id' => $profile->id,
        ]);
    }
}
