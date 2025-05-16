<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Accounting;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountingFactory extends Factory
{
    protected $model = Accounting::class;

    public function definition(): array
    {
        $fields = [
            'accounting_dec',
            'create_cre',
            'expense_allocation',
        ];

        $labels = [
            'accounting_dec' => 'Predisporre la contabilità delle attività eseguite ed inviarla al DEC',
            'create_cre' => 'Creazione CRE',
            'expense_allocation' => 'Riparto spese',
        ];

        $trueField = $this->faker->randomElement($fields);

        $data = [];
        foreach ($fields as $field) {
            $data[$field] = $field === $trueField;
        }

        $clientIds = Client::pluck('id')->toArray();
        
        return [
            'client_id' => fake()->randomElement($clientIds),
            'project_id' => \App\Models\Project::factory(),
            'name_phase' => $labels[$trueField],
            'user' => fake()->name(),
            'status' => fake()->randomElement(['Svolto', 'In attesa']),
            'accounting' => $this->faker->text(),
            'user_accounting' => \App\Models\User::factory(),
            'status_accounting' => 'pending',
            'accounting_dec' => $this->faker->text(),
            'user_accounting_dec' => \App\Models\User::factory(),
            'status_accounting_dec' => 'pending',
            'create_cre' => $this->faker->text(),
            'user_create_cre' => \App\Models\User::factory(),
            'status_create_cre' => 'pending',
            'expense_allocation' => $this->faker->text(),
            'user_expense_allocation' => \App\Models\User::factory(),
            'status_expense_allocation' => 'pending',
        ];
    }
}