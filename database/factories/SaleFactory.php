<?php

namespace Database\Factories;

use App\Models\Sale;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleFactory extends Factory
{
    protected $model = Sale::class;

    public function definition(): array
    {
        return [
            'client_id' => Client::factory(), 
            'invoice' => $this->faker->unique()->word,
            'price' => $this->faker->randomFloat(2, 100, 1000), 
            'status' => $this->faker->randomElement([1, 0]),
            'date' => $this->faker->date,
        ];
    }

    public function fixed(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'client_id' => 1,
                'invoice' => $this->faker->unique()->word,
                'price' => $this->faker->randomFloat(2, 100, 1000), 
                'status' => $this->faker->randomElement([1, 0]),
                'date' => $this->faker->date,
            ];
        });
    }
}
