<?php

namespace Database\Factories;

use App\Models\NoteProject;
use App\Models\Project;
use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoteProjectFactory extends Factory
{
    protected $model = NoteProject::class;

    public function definition()
    {
        return [
            'project_id' => Project::factory(),
            'client_id' => Client::factory(),
            'note' => $this->faker->paragraph(3),
            'user_name' => $this->faker->name(),
            'user_id'    => User::factory(),
            'role' => $this->faker->randomElement(['Admin', 'User']),
        ];
    }

    public function fixed(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'client_id' => 1,
                'project_id' => Project::factory(),
                'note' => $this->faker->paragraph(3),
                'user_id' => 1,
                'user_name' => "Admin Lastname",
                'role' => "Admin",
            ];
        });
    }
}
