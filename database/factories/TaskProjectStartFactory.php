<?php

namespace Database\Factories;

use App\Models\TaskProjectStart;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskProjectStartFactory extends Factory
{
    protected $model = TaskProjectStart::class;

    public function definition()
    {
        return [
            'project_id' => $this->faker->randomNumber(),
            'client_id' => $this->faker->randomNumber(),
            'project_start_id' => $this->faker->randomNumber(),
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
