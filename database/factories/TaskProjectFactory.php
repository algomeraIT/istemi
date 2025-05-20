<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskProjectFactory extends Factory
{
    public function definition(): array
    {
        $clientIds = Client::pluck('id')->toArray();

        return [
            'project_id' => Project::factory(),
            'client_id' => fake()->randomElement($clientIds),
            'user_id' => User::factory(),
            'user_name' => $this->faker->name(),
            'title' => $this->faker->sentence(6),
            'assignee' => $this->faker->name(),
            'cc' => $this->faker->name(),
            'expire' => $this->faker->date(),
            'note' => $this->faker->text(),
            'media' => json_encode([$this->faker->randomNumber(), $this->faker->randomNumber()]),
            'status' => $this->faker->randomElement(['In attesa', 'Svolto']),
        ];
    }
}
