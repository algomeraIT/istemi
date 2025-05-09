<?php

namespace Database\Factories;

use App\Models\Communication;
use App\Models\Attach;
use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Client;


class CommunicationFactory extends Factory
{
    protected $model = Communication::class;

    public function definition(): array
    {
        return [
            'task' => $this->faker->sentence,
            'client_id' => Client::factory(), 

            'assigned_to' => $this->faker->name,
            'deadline' => $this->faker->date(),
            'to_do' => $this->faker->paragraph,
            'sender' => $this->faker->email,
            'receiver' => $this->faker->email,
            'attach_id' => Attach::factory(), 
            'has_multiple_attaches' => $this->faker->boolean,
            'id_multiple_attaches' => $this->faker->uuid,
            'notes' => Note::factory(),
            'user_id' => User::factory(),
            'name_user' => $this->faker->firstName,
            'last_name_user' => $this->faker->lastName,
            'job_position_user' => $this->faker->jobTitle,
            'status_user' => $this->faker->word,
            'action' => $this->faker->word,
            'note' => $this->faker->paragraph,
        ];
    }
}
