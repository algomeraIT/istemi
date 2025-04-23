<?php

namespace Database\Factories;

use App\Models\Acquisition;
use App\Models\Clients;
use Illuminate\Database\Eloquent\Factories\Factory;

class AcquisitionFactory extends Factory
{
    protected $model = Acquisition::class;

    public function definition(): array
    {
        return [
            'client_id' => Clients::factory(),
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
