<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Area;
use App\Models\MicroArea;
use App\Models\Project;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Phase>
 */
class PhaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_area' => Area::inRandomOrder()->value('id'),
            'id_micro_area' => MicroArea::inRandomOrder()->value('id'),
            'id_project' => Project::inRandomOrder()->value('id'),
            'id_user' => User::inRandomOrder()->value('id'),
            'status' => $this->faker->randomElement(['In attesa', 'Svolto']),
        ];
    }
}
   