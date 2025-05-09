<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = User::class;

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
            'role' => fake()->randomElement(['admin', 'user', 'client']),
            'job_position' => fake()->jobTitle(),
            'status' => fake()->randomElement([0, 1]),
            'remember_me' => fake()->boolean(50),
            'email_verified_at' => now(),
        ];
    }
}