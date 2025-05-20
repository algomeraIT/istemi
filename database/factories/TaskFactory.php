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
            'id_phases' => Phase::factory(),
            'id_assignee' => User::factory(),
            'status' => $this->faker->randomElement(['In attesa', 'Svolto']),
            'title' => $this->faker->sentence(6),
            'assignee' => $this->faker->name(),
            'cc' => $this->faker->name(),
            'expire' => $this->faker->date(),
            'note' => $this->faker->text(),
            'media' => json_encode([$this->faker->randomNumber(), $this->faker->randomNumber()]),
        ];
    }
}