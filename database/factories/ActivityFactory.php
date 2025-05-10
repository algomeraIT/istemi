<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityFactory extends Factory
{
    public function definition(): array
    {
        return [
            'client_id' => Client::factory(),
            'project_id' => Project::factory(),

            'activities' => $this->faker->boolean,
            'user_activities' => User::factory(),
            'status_activities' => $this->faker->randomElement(['pending', 'completed']),

            'team' => $this->faker->boolean,
            'user_team' => User::factory(),
            'status_team' => $this->faker->randomElement(['ok', 'pending']),

            'field_activities' => $this->faker->boolean,
            'user_field_activities' => User::factory(),
            'status_field_activities' => $this->faker->randomElement(['ok', 'pending']),

            'daily_check_activities' => $this->faker->boolean,
            'user_daily_check_activities' => User::factory(),
            'status_daily_check_activities' => $this->faker->randomElement(['ok', 'pending']),

            'contruction_site_media' => $this->faker->boolean,
            'user_contruction_site_media' => User::factory(),
            'status_contruction_site_media' => $this->faker->randomElement(['ok', 'pending']),

            'activity_validation' => $this->faker->boolean,
            'user_activity_validation' => User::factory(),
            'status_activity_validation' => $this->faker->randomElement(['ok', 'pending']),
        ];
    }
}