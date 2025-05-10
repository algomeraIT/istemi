<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'client_id' => \App\Models\Client::factory(),
            'project_id' => \App\Models\Project::factory(),
    
            'report' => $this->faker->boolean,
            'user_report' => \App\Models\User::factory(),
            'status_report' => $this->faker->randomElement(['pending', 'completed']),
    
            'create_note' => $this->faker->boolean,
            'user_create_note' => \App\Models\User::factory(),
            'status_create_note' => $this->faker->randomElement(['pending', 'completed']),
    
            'sending_note' => $this->faker->boolean,
            'user_sending_note' => \App\Models\User::factory(),
            'status_sending_note' => $this->faker->randomElement(['pending', 'completed']),
        ];
    }
}
