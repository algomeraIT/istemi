<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make('password'), // Default password
            'has_to_change_password' => fake()->boolean(10),
            'image_path' => fake()->imageUrl(),
            'cellphone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'city' => fake()->city(),
            'province' => fake()->state(),
            'cap' => fake()->postcode(),
            'role' => fake()->randomElement(['admin', 'user', 'client', 'area', 'project']),
            'job_position' => fake()->jobTitle(),
            'status' => fake()->randomElement([0, 1]),
            'remember_me' => fake()->boolean(50),
            'email_verified_at' => now(),
        ];
    }



    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
