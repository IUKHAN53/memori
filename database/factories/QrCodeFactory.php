<?php

namespace Database\Factories;

use App\Models\Profile;
use App\Models\QrCode;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\QrCode>
 */
class QrCodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'identifier' => Str::random(12),
            'secret_phrase' => fake()->words(3, true),
            'profile_id' => null,
            'path' => fake()->optional(0.5)->imageUrl(300, 300, 'abstract'),
            'is_assigned' => false,
            'assigned_at' => null,
        ];
    }

    /**
     * Indicate that the QR code is assigned to a profile.
     */
    public function assigned(): static
    {
        return $this->state(fn (array $attributes) => [
            'profile_id' => Profile::factory(),
            'is_assigned' => true,
            'assigned_at' => now(),
        ]);
    }

    /**
     * Indicate that the QR code is unassigned.
     */
    public function unassigned(): static
    {
        return $this->state(fn (array $attributes) => [
            'profile_id' => null,
            'is_assigned' => false,
            'assigned_at' => null,
        ]);
    }
}
