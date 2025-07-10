<?php

namespace Database\Factories;

use App\Models\Profile;
use App\Models\ProfileVideos;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProfileVideos>
 */
class ProfileVideosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $videoIds = [
            'dQw4w9WgXcQ', 'J---aiyznGQ', 'kJQP7kiw5Fk', 'L_jWHffIx5E',
            'hT_nvWreIhg', 'YQHsXMglC9A', 'djV11Xbc914', 'fJ9rUzIMcZQ'
        ];
        
        return [
            'profile_id' => Profile::factory(),
            'url' => 'https://www.youtube.com/watch?v=' . fake()->randomElement($videoIds),
            'title' => fake()->sentence(4),
            'description' => fake()->optional(0.7)->paragraph(),
        ];
    }

    /**
     * Indicate that the video belongs to a specific profile.
     */
    public function forProfile(Profile $profile): static
    {
        return $this->state(fn (array $attributes) => [
            'profile_id' => $profile->id,
        ]);
    }
}
