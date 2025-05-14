<?php

namespace Database\Factories;

use App\Models\CloseActivity;
use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CloseActivityFactory extends Factory
{
    protected $model = CloseActivity::class;

    public function definition(): array
    {
        $fields = [
            'sale',
            'release',
        ];

        $labels = [
            'sale' => 'Fatturato specifico',
            'release' => 'Svincolo dalla polizza',
        ];


        $trueField = $this->faker->randomElement($fields);

        $data = [];
        foreach ($fields as $field) {
            $data[$field] = $field === $trueField;
        }

        $project = Project::first();
        $client = Client::first();

        return [
            'client_id' => $client->id,
            'project_id' => $project->id,
            'close_activity' => $this->faker->sentence,
            'name_phase' => $labels[$trueField],

            'user' => fake()->name(),
            'status' => fake()->randomElement(['Svolto', 'In attesa']),
            'user_close_activity' => User::factory(),
            'status_close_activity' => 'completed',
            'sale' => $this->faker->sentence,
            'user_sale' => User::factory(),
            'status_sale' => 'approved',
            'release' => $this->faker->sentence,
            'user_release' => User::factory(),
            'status_release' => 'released',
        ];
    }
}
