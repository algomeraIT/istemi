<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Phase;
use App\Models\User;

class TaskFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'id_phases' => Phase::factory(),
            'id_assignee' => User::factory(),
            'status' => $this->faker->randomElement(['In attesa', 'Svolto']),
        ];
    }
}