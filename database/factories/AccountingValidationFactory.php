<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AccountingValidation>
 */
class AccountingValidationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'client_id' => Client::factory(),
            'project_id' => Project::factory(),
        
            'accounting_validation' => $this->faker->boolean,
            'user' => fake()->name(),
            'status' => fake()->randomElement(['approved', 'pending']),
            'user_accounting_validation' => User::factory(),
            'status_accounting_validation' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
        
            'balance' => $this->faker->boolean,
            'user_balance' => User::factory(),
            'status_balance' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
        
            'cre_archiving' => $this->faker->boolean,
            'user_cre_archiving' => User::factory(),
            'status_cre_archiving' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
        
            'pay_suppliers' => $this->faker->boolean,
            'user_pay_suppliers' => User::factory(),
            'status_pay_suppliers' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
        
            'pay_allocation_expenses' => $this->faker->boolean,
            'user_pay_allocation_expenses' => User::factory(),
            'status_pay_allocation_expenses' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
        
            'learned_lesson' => $this->faker->boolean,
            'user_learned_lesson' => User::factory(),
            'status_learned_lesson' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
        ];
    }
}
