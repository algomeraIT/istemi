<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NoteFactory extends Factory
{
    public function definition()
    {
        return [
            'content' => $this->faker->paragraph,
            'created_by' => null,
            'updated_by' => null,
        ];
    }
}
