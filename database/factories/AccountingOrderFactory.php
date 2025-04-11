<?php

namespace Database\Factories;

use App\Models\AccountingOrder;
use App\Models\Clients;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountingOrderFactory extends Factory
{
    protected $model = AccountingOrder::class;

    public function definition(): array
    {
        return [
            'client_id' => Clients::factory(),
            'order_number' => $this->faker->unique()->numerify('ORD-#####'),
            'date' => $this->faker->date,
            'country' => $this->faker->country,
            'shipper' => $this->faker->company,
            'total_price' => $this->faker->randomFloat(2, 100, 10000),
            'status' => 1,
        ];
    }
}
