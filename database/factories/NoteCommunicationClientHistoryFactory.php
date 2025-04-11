<?php

namespace Database\Factories;

use App\Models\NoteCommunicationClientHistory;
use App\Models\Clients;
use App\Models\Users;
use App\Models\Note;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoteCommunicationClientHistoryFactory extends Factory
{
    protected $model = NoteCommunicationClientHistory::class;

    public function definition(): array
    {
        return [
            'client_id' => Clients::factory(), 
            'user_id' => Users::factory(), 
            'name_user' => $this->faker->name,
            'last_name_user' => $this->faker->lastName,
            'role_user' => $this->faker->word,
            'attach_id' => $this->faker->optional()->randomDigit, 
            //'id_note' => Note::factory(), 
        ];
    }
}
