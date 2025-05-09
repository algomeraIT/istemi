<?php

namespace Database\Factories;

use App\Models\Referent;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReferentFactory extends Factory
{
    protected $model = Referent::class;

    public function definition(): array
    {
        return [
            'client_id' => Client::factory(), 
            'name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'title' => $this->faker->optional()->title,
            'job_position' => $this->faker->optional()->jobTitle,
            'email' => $this->faker->unique()->safeEmail,
            'telephone' => $this->faker->phoneNumber,
            'note' => $this->faker->optional()->text,
            'status' => $this->faker->randomElement([1, 0]), 
            'role' => $this->faker->word,
        ];
    }

    public function fixed(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'client_id' => 1,
                'name' => $this->faker->firstName,
                'last_name' => $this->faker->lastName,
                'title' => $this->faker->optional()->title,
                'job_position' => $this->faker->optional()->jobTitle,
                'email' => $this->faker->unique()->safeEmail,
                'telephone' => $this->faker->phoneNumber,
                'note' => $this->faker->optional()->text,
                'status' => $this->faker->randomElement([1, 0]), 
                'role' => $this->faker->word,
            ];
        });
    }
}
