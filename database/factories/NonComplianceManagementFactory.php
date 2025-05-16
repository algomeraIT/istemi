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
        $fields = [
            'sa',
            'integrate_doc',
        ];

        $labels = [
            'sa' => 'Accogliere le richieste/integrazioni della S.A.',
            'integrate_doc' => 'Produrre ed inviare documentazione integrativa',
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
            'non_compliance_management' => $this->faker->sentence(),
             'name_phase' => $labels[$trueField],

            'user' => fake()->name(),
            'status' => fake()->randomElement(['Svolto', 'In attesa']),
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
