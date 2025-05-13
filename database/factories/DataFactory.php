<?php

namespace Database\Factories;

use App\Models\Data;
use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DataFactory extends Factory
{
    protected $model = Data::class;

    public function definition(): array
    {
        $clientIds = Client::pluck('id')->toArray();

        return [
            'client_id' => fake()->randomElement($clientIds),
            'project_id' => Project::factory(),

            'data' => $this->faker->paragraph,
            'user' => fake()->name(),
            'status' => fake()->randomElement(['approved', 'pending']),
            'user_data' => User::factory(),
            'status_data' => $this->faker->randomElement(['pending', 'approved', 'rejected']),

            'foreman_docs' => $this->faker->sentence,
            'user_foreman_docs' => User::factory(),
            'status_foreman_docs' => $this->faker->randomElement(['pending', 'approved']),

            'sanding_sample_lab' => $this->faker->sentence,
            'user_sanding_sample_lab' => User::factory(),
            'status_sanding_sample_lab' => $this->faker->randomElement(['sent', 'processing', 'done']),

            'data_validation' => $this->faker->sentence,
            'user_data_validation' => User::factory(),
            'status_data_validation' => $this->faker->randomElement(['valid', 'invalid']),

            'internal_validation' => $this->faker->sentence,
            'user_internal_validation' => User::factory(),
            'status_internal_validation' => $this->faker->randomElement(['yes', 'no']),
        ];
    }
}