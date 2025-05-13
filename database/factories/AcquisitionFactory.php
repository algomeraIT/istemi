<?php

namespace Database\Factories;

use App\Models\Acquisition;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class AcquisitionFactory extends Factory
{
    protected $model = Acquisition::class;

    public function definition(): array
    {
        $clientIds = Client::pluck('id')->toArray();

        return [
            'client_id' => fake()->randomElement($clientIds),
            'invoice' => $this->faker->unique()->numerify('INV-#####'),
            'total_price' => $this->faker->randomFloat(2, 100, 10000),
            'status' => $this->faker->randomElement([0, 1, 2]),
            'date' => $this->faker->date,
        ];
    }

    public function fixed(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'client_id' => 1,
                'invoice' => $this->faker->unique()->numerify('INV-#####'),
                'total_price' => $this->faker->randomFloat(2, 100, 10000),
                'status' => $this->faker->randomElement([0, 1, 2]),
                'date' => $this->faker->date,
            ];
        });
    }
}
