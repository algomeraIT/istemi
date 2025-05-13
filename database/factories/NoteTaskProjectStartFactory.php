<?php

namespace Database\Factories;

use App\Models\NoteTaskProjectStart;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoteTaskProjectStartFactory extends Factory
{
    protected $model = NoteTaskProjectStart::class;

    public function definition(): array
    {
        return [
            'task_id' => \App\Models\TaskProjectStart::factory(),
            'project_id' => \App\Models\Project::factory(),
            'note' => $this->faker->paragraph,
            'attachment' => [$this->faker->uuid],
        ];
    }
}