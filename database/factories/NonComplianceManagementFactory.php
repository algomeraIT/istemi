<?php

namespace Database\Factories;

use App\Models\NonComplianceManagement;
use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class NonComplianceManagementFactory extends Factory
{
    protected $model = NonComplianceManagement::class;

    public function definition(): array
    {
        return [
            'client_id' => Client::factory(),
            'project_id' => Project::factory(),
            'non_compliance_management' => $this->faker->sentence(),
            'user' => fake()->name(),
            'status' => fake()->randomElement(['approved', 'pending']),
            'user_non_compliance_management' => User::factory(),
            'status_non_compliance_management' => 'pending',

            'sa' => $this->faker->sentence(),
            'user_sa' => User::factory(),
            'status_sa' => 'approved',

            'integrate_doc' => $this->faker->sentence(),
            'user_integrate_doc' => User::factory(),
            'status_integrate_doc' => 'in_review',
        ];
    }
}
