<?php

namespace Database\Factories;

use App\Models\NoteCommunicationClient;
use App\Models\Client;
use App\Models\User;
use App\Models\Note;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoteCommunicationClientFactory extends Factory
{
    protected $model = NoteCommunicationClient::class;

    public function definition(): array
    {
        return [
            'client_id' => Client::factory(), 
            'user_id' => User::factory(), 
            'name_user' => $this->faker->firstName,
            'last_name_user' => $this->faker->lastName,
            'role_user' => $this->faker->randomElement(['admin', 'manager', 'employee']),
            'attach_id' => $this->faker->optional()->randomDigitNotNull,
            'id_note' => Note::factory(), 
        ];
    }
}
