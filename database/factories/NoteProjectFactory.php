<?php

namespace Database\Factories;

use App\Models\NoteProject;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoteProjectFactory extends Factory
{
    protected $model = NoteProject::class;

    public function definition()
    {
        return [
            'project_id' => Project::inRandomOrder()->value('id'),
            'note' => $this->faker->paragraph(3),
            'user_name' => $this->faker->name(),
            'user_id'    => User::inRandomOrder()->value('id'),
            'role' => $this->faker->randomElement(['Admin', 'User']),
        ];
    }
}
