<?php

namespace Database\Factories;

use App\Models\ActivityCommunicationClientHistory;
use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityCommunicationClientHistoryFactory extends Factory
{
    protected $model = ActivityCommunicationClientHistory::class;

    public function definition(): array
    {
        $clientIds = Client::whereIn('status', ['cliente', 'contatto'])->pluck('id')->toArray();

        return [
            'client_id' => fake()->randomElement($clientIds),
            'name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'role' => $this->faker->jobTitle,
            'label' => $this->faker->word,
            'to_do' => $this->faker->sentence,
            'activities' => $this->faker->paragraph,
            'assignee' => $this->faker->name,
            'expire_at' => $this->faker->optional()->date(),
            'user_id' => User::factory()
        ];
    }
}
