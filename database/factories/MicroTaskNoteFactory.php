<?php

namespace Database\Factories;

use App\Models\MicroTaskNote;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MicroTaskNoteFactory extends Factory
{
    protected $model = MicroTaskNote::class;

    public function definition(): array
    {
        return [
            'note' => $this->faker->paragraph,
            'id_task' => Task::factory(),
            'id_user' => User::factory(),
            'status' => $this->faker->randomElement(['attivo', 'completato']),
        ];
    }
}