<?php

namespace Database\Factories;

use App\Models\Note;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoteFactory extends Factory
{
    public function definition()
    {
        $clientIds = Client::pluck('id')->toArray();

        return [
            'client_id' => fake()->randomElement($clientIds),
            'content' => $this->faker->paragraph,
            'created_by' => null,
            'updated_by' => null,
        ];
    }
}
