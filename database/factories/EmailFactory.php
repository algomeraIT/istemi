<?php

namespace Database\Factories;

use App\Models\Email;
use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmailFactory extends Factory
{
    protected $model = Email::class;

    public function definition(): array
    {
        $clientIds = Client::pluck('id')->toArray();
        $userIds = User::pluck('id')->toArray();

        return [
            'client_id' => fake()->randomElement($clientIds),
            'sent_by' => fake()->randomElement($userIds),
            'to' => collect(array_merge(
                User::pluck('email')->toArray(),
                Client::pluck('email')->toArray()
            ))->random(3)->values()->all(),
            'subject' => $this->faker->word,
            'body' => $this->faker->paragraph,
            'created_by' => null,
            'updated_by' => null,
        ];
    }
}
