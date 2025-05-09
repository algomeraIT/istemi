<?php

namespace Database\Factories;

use App\Models\NoteCommunicationClientHistory;
use App\Models\Client;
use App\Models\User;
use App\Models\Note;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoteCommunicationClientHistoryFactory extends Factory
{
    protected $model = NoteCommunicationClientHistory::class;

    public function definition(): array
    {
        return [
            'client_id' => Client::factory(), 
            'user_id' => User::factory(), 
            'name_user' => $this->faker->name,
            'last_name_user' => $this->faker->lastName,
            'role_user' => $this->faker->word,
            'attach_id' => $this->faker->optional()->randomDigit, 
            //'id_note' => Note::factory(), 
        ];
    }

    public function fixed(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'client_id' => 1,
                'name_user' => $this->faker->name,
                'last_name_user' => $this->faker->lastName,
                'role_user' => $this->faker->word,
                'attach_id' => $this->faker->optional()->randomDigit, 
                'user_id' => 1
            ];
        });
    }
}
