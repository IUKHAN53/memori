<?php

namespace Database\Factories;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $dateOfBirth = fake()->dateTimeBetween('-100 years', '-20 years');
        $dateOfDeath = fake()->dateTimeBetween($dateOfBirth, 'now');
        
        return [
            'first_name' => fake()->firstName(),
            'middle_name' => fake()->optional(0.3)->firstName(),
            'last_name' => fake()->lastName(),
            'title' => fake()->optional(0.4)->randomElement(['Dr.', 'Mr.', 'Mrs.', 'Ms.', 'Prof.']),
            'relationship' => fake()->optional(0.6)->randomElement(['Father', 'Mother', 'Husband', 'Wife', 'Son', 'Daughter', 'Brother', 'Sister', 'Friend']),
            'picture' => fake()->optional(0.7)->imageUrl(300, 300, 'people'),
            'cover_photo' => fake()->optional(0.5)->imageUrl(800, 400, 'nature'),
            'city' => fake()->city(),
            'state' => fake()->state(),
            'obituary_link' => fake()->optional(0.3)->url(),
            'bio' => fake()->optional(0.8)->paragraphs(3, true),
            'heading_text' => fake()->optional(0.4)->sentence(),
            'include_heading_text' => fake()->boolean(70),
            'quote_text' => fake()->optional(0.3)->sentence(),
            'date_of_birth' => $dateOfBirth,
            'date_of_death' => $dateOfDeath,
            'cemetery_name' => fake()->optional(0.6)->company() . ' Cemetery',
            'cemetery_plot' => fake()->optional(0.6)->bothify('Section ##, Plot ###'),
            'cemetery_city' => fake()->optional(0.6)->city(),
            'cemetery_state' => fake()->optional(0.6)->state(),
            'cemetery_lat' => fake()->optional(0.6)->latitude(),
            'cemetery_lng' => fake()->optional(0.6)->longitude(),
            'donations_url' => fake()->optional(0.2)->url(),
            'is_public' => fake()->boolean(80),
            'user_id' => User::factory(),
        ];
    }

    /**
     * Indicate that the profile is public.
     */
    public function public(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_public' => true,
        ]);
    }

    /**
     * Indicate that the profile is private.
     */
    public function private(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_public' => false,
        ]);
    }
}
