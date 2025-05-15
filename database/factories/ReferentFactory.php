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
        $clientIds = Client::where('status', 'cliente')->pluck('id')->toArray();

        return [
            'client_id' => fake()->randomElement($clientIds), 
            'name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'title' => $this->faker->optional()->title,
            'job_position' => $this->faker->optional()->jobTitle,
            'email' => $this->faker->unique()->safeEmail,
            'telephone' => $this->faker->phoneNumber,
            'note' => $this->faker->optional()->text,
        ];
    }
}
