<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoicesSalFactory extends Factory
{
    public function definition(): array
    {
        return [
            'client_id' => Client::factory(),
            'project_id' => Project::factory(),

            'invoices_sal' => $this->faker->boolean,
            'user_invoices_sal' => User::factory(),
            'status_invoices_sal' => $this->faker->randomElement(['pending', 'approved', 'rejected']),

            'emission_invoice' => $this->faker->boolean,
            'user_emission_invoice' => User::factory(),
            'status_emission_invoice' => $this->faker->randomElement(['pending', 'done', 'canceled']),

            'payment_invoice' => $this->faker->boolean,
            'user_payment_invoice' => User::factory(),
            'status_payment_invoice' => $this->faker->randomElement(['unpaid', 'paid', 'failed']),
        ];
    }
}
