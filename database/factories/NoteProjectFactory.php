<?php

namespace Database\Factories;

use App\Models\NoteProject;
use App\Models\Project;
use App\Models\Clients;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoteProjectFactory extends Factory {
    protected $model = NoteProject::class;

    public function definition() {
        return [
            'project_id' => Project::factory(),
            'client_id' => Clients::factory(),
            'note' => $this->faker->paragraph(3),
        ];
    }

    public function fixed(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'client_id' => 1,
                'project_id' => Project::factory(),
                'note' => $this->faker->paragraph(3),
            ];
        });
    }
}
