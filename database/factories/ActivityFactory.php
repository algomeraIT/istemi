<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityFactory extends Factory
{
    public function definition(): array
    {
        $clientIds = Client::pluck('id')->toArray();

        $status = ['nuovo', 'in attesa', 'completato', 'sospeso'];
        $randomStatus = fake()->randomElement($status);

        $expiration = now()->addDays(3);

        $complete = null;

        if ($randomStatus == 'completato') {
            $complete = now()->addDays(2);
        }

        return [
            'client_id' => fake()->randomElement($clientIds),
            'title' =>  fake()->randomElement(['chiama', 'invia e-mail']),
            'note' => $this->faker->paragraph,
            'status' => fake()->randomElement($status),
            'expiration' => $expiration,
            'completed_at' => $complete,
            'created_by' => null,
            'updated_by' => null,
        ];
    }
}
