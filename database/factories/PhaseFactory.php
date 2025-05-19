<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Area;
use App\Models\MicroArea;
use App\Models\User;

class PhaseFactory extends Factory
{
    public function definition(): array
    {
        return [
            'id_area' => Area::factory(),
            'id_micro_area' => MicroArea::factory(),
            'id_project' => $this->faker->randomDigitNotZero(),
            'id_user' => User::factory(),
            'status' => $this->faker->randomElement(['In attesa', 'Svolto']),
        ];
    }
}