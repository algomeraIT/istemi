<?php

namespace Database\Factories;

use App\Models\Estimate;
use Illuminate\Database\Eloquent\Factories\Factory;

class EstimateFactory extends Factory
{
    protected $model = Estimate::class;

    public function definition(): array
    {
        return [
            'serial_number' => $this->faker->unique()->word,
            'date_expiration' => $this->faker->date,
            'status_expiration' => $this->faker->randomElement(['expired', 'valid', 'pending']),
            'price' => $this->faker->randomFloat(2, 50, 500),
            'total' => $this->faker->randomFloat(2, 100, 1000),
            'status' => $this->faker->numberBetween(0, 1),
        ];
    }
}
