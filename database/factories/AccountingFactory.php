<?php

namespace Database\Factories;

use App\Models\Accounting;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountingFactory extends Factory
{
    protected $model = Accounting::class;

    public function definition(): array
    {
        return [
            'client_id' => \App\Models\Client::factory(),
            'project_id' => \App\Models\Project::factory(),
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