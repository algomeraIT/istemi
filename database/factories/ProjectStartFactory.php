<?php

namespace Database\Factories;

use App\Models\Client;
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
    public function definition()
    {
        $fields = [
            'contract_ver',
            'cme_ver',
            'reserves',
            'expiring_date_project',
            'communication_plan',
            'extension',
            'sal',
            'warranty',
        ];

        $labels = [
            'contract_ver' => 'Verifica contratto',
            'cme_ver' => 'Verifica CME',
            'reserves' => 'Riserve',
            'expiring_date_project' => 'Impostare data di scadenza progetto',
            'communication_plan' => 'Definizione del piano di comunicazione',
            'extension' => 'Proroga',
            'sal' => 'Possibilità di produrre dei SAL',
            'warranty' => 'Garanzia definitiva',
        ];

        $trueField = $this->faker->randomElement($fields);

        $data = [];
        foreach ($fields as $field) {
            $data[$field] = $field === $trueField;
        }

        $clientIds = Client::pluck('id')->toArray();

        return array_merge($data, [
            'client_id' => fake()->randomElement($clientIds),
            'project_id' => \App\Models\Project::factory(),
            'name_phase' => $labels[$trueField],
            'user' => fake()->name(),
            'status' => fake()->randomElement(['approved', 'pending']),

            'user_contract_ver' => fake()->name(),
            'status_contract_ver' => 'pending',

            'user_cme_ver' => fake()->name(),
            'status_cme_ver' => 'approved',

            'user_reserves' => fake()->name(),
            'status_reserves' => 'rejected',

            'user_expiring_date_project' => $this->faker->date(),
            'status_expiring_date_project' => 'pending',

            'user_communication_plan' => fake()->name(),
            'status_communication_plan' => 'pending',

            'user_extension' => fake()->name(),
            'status_extension' => 'pending',

            'user_sal' => fake()->name(),
            'status_sal' => 'approved',

            'user_warranty' => fake()->name(),
            'status_warranty' => 'approved',
        ]);
    }
}
