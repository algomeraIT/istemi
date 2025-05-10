<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Client;
use App\Models\Project;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ExternalValidation>
 */
class ExternalValidationFactory extends Factory
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
    
            'external_validation' => $this->faker->boolean,
            'user_external_validation' => User::factory(),
            'status_external_validation' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
    
            'cre' => $this->faker->boolean,
            'user_cre' => User::factory(),
            'status_cre' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
    
            'liquidation' => $this->faker->boolean,
            'user_liquidation' => User::factory(),
            'status_liquidation' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
    
            'balance_invoice' => $this->faker->boolean,
            'user_balance_invoice' => User::factory(),
            'status_balance_invoice' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
        ];
    }
}
