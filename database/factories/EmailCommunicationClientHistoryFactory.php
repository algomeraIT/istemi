<?php

namespace Database\Factories;

use App\Models\EmailCommunicationClientHistory;
use App\Models\Clients;
use App\Models\Attach;
use App\Models\Users;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmailCommunicationClientHistoryFactory extends Factory
{
    protected $model = EmailCommunicationClientHistory::class;

    public function definition(): array
    {
        return [
            'client_id' => Clients::factory(),
            'task' => $this->faker->sentence,
            'assigned_to' => $this->faker->name,
            'sender' => $this->faker->email,
            'receiver' => $this->faker->email,
            'attach_id' => Attach::factory(),
            'has_multiple_attaches' => $this->faker->boolean,
            'id_multiple_attaches' => $this->faker->uuid,
            'user_id' => Users::factory(),
            'name_user' => $this->faker->firstName,
            'last_name_user' => $this->faker->lastName,
            'job_position_user' => $this->faker->jobTitle,
            'status_user' => $this->faker->numberBetween(1, 2),
            'action' => $this->faker->word,
            'note' => $this->faker->paragraph,
        ];
    }

    public function fixed(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'client_id' => 1,
                'task' => $this->faker->sentence,
                'assigned_to' => $this->faker->name,
                'sender' => $this->faker->email,
                'receiver' => $this->faker->email,
                'attach_id' => Attach::factory(),
                'has_multiple_attaches' => $this->faker->boolean,
                'id_multiple_attaches' => $this->faker->uuid,
                'user_id' => 1,
                'name_user' => $this->faker->firstName,
                'last_name_user' => $this->faker->lastName,
                'job_position_user' => $this->faker->jobTitle,
                'status_user' => $this->faker->numberBetween(1, 2),
                'action' => $this->faker->word,
                'note' => $this->faker->paragraph,
            ];
        });
    }
}
