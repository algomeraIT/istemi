<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProjectStart>
 */
class ProjectStartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'client_id' => \App\Models\Clients::factory(),
            'project_id' => \App\Models\Project::factory(),
    
            'contract_ver' => $this->faker->boolean,
            'user_contract_ver' => $this->faker->word,
            'status_contract_ver' => 'pending',
    
            'cme_ver' => $this->faker->boolean,
            'user_cme_ver' => $this->faker->word,
            'status_cme_ver' => 'approved',
    
            'reserves' => $this->faker->boolean,
            'user_reserves' => $this->faker->word,
            'status_reserves' => 'rejected',
    
            'expiring_date_project' => $this->faker->boolean,
            'user_expiring_date_project' => $this->faker->date(),
            'status_expiring_date_project' => 'pending',
    
            'communication_plan' => $this->faker->boolean,
            'user_communication_plan' => $this->faker->word,
            'status_communication_plan' => 'pending',
    
            'extension' => $this->faker->boolean,
            'user_extension' => $this->faker->word,
            'status_extension' => 'pending',
    
            'sal' => $this->faker->boolean,
            'user_sal' => $this->faker->word,
            'status_sal' => 'approved',
    
            'warranty' => $this->faker->boolean,
            'user_warranty' => $this->faker->word,
            'status_warranty' => 'approved',
        ];
    }
}
