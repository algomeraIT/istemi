<?php

namespace Database\Factories;

use App\Models\TaskProjectStart;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Project;
use App\Models\Client;
use App\Models\ProjectStart;
use App\Models\User;

class TaskProjectStartFactory extends Factory
{
    protected $model = TaskProjectStart::class;

    public function definition()
    {
        $clientIds = Client::pluck('id')->toArray();

        return [
            'project_id' => Project::factory(),
            'client_id' => fake()->randomElement($clientIds),
            'project_start_id' => ProjectStart::factory(),
            'user_id' => User::factory(),
            'user_name' => $this->faker->name(),
            'title' => $this->faker->sentence(),
            'assignee' => $this->faker->name(),
            'cc' => $this->faker->name(),
            'expire' => $this->faker->date(),
            'note' => $this->faker->paragraph(),
            'media' => json_encode([$this->faker->randomNumber(), $this->faker->randomNumber()]),
            'status' => $this->faker->randomElement(['Svolto', 'In attesa']),
        ];
    }
}
