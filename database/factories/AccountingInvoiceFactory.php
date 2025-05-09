<?php

namespace Database\Factories;

use App\Models\AccountingInvoice;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountingInvoiceFactory extends Factory
{
    protected $model = AccountingInvoice::class;

    public function definition(): array
    {
        return [
            'client_id' => Client::factory(), 
            'number_invoice' => $this->faker->unique()->numerify('INV-#####'),
            'date_invoice' => $this->faker->date,
            'expire_invoice' => $this->faker->date,
            'taxable' => $this->faker->randomFloat(2, 100, 1000), 
            'total' => $this->faker->randomFloat(2, 100, 1000), 
            'status' => $this->faker->randomElement([1, 0]), 
        ];
    }
}
