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
        $fields = [
            'emission_invoice',
            'payment_invoice',
        ];

        $labels = [
            'emission_invoice' => 'Emissione fattura',
            'payment_invoice' => 'Pagamento fattura',
        ];

        $trueField = $this->faker->randomElement($fields);

        $data = [];
        foreach ($fields as $field) {
            $data[$field] = $field === $trueField;
        }


        $clientIds = Client::pluck('id')->toArray();

        return [
            'client_id' => fake()->randomElement($clientIds),
            'project_id' => Project::factory(),

            'invoices_sal' => $this->faker->boolean,
            'name_phase' => $labels[$trueField],

            'user' => fake()->name(),
            'status' => fake()->randomElement(['Svolto', 'In attesa']),
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
