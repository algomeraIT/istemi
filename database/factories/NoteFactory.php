<?php

namespace Database\Factories;

use App\Models\Note;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoteFactory extends Factory
{
    protected $model = Note::class;

    public function definition()
    {
        return [
            'is_leads' => $this->faker->boolean,
            'is_email' => $this->faker->boolean,
            'body' => $this->faker->paragraph,
            'status' => $this->faker->randomElement([0, 1]),
        ];
    }
}
