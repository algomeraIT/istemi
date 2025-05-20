<?php

namespace Database\Factories;

use App\Models\MicroTaskNote;
use App\Models\Project;
use App\Models\Phase;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MicroTaskNoteFactory extends Factory
{
    protected $model = MicroTaskNote::class;

    public function definition(): array
    {
        return [
            'project_id' => Project::inRandomOrder()->value('id'),
            'id_phase' => Phase::inRandomOrder()->value('id'),
            'note' => $this->faker->paragraph(3),
            'user_name' => $this->faker->name(),
            'user_id'    => User::inRandomOrder()->value('id'),
            'role' => $this->faker->randomElement(['Admin', 'User']),
        ];
    }
}