<?php

namespace Database\Factories;

use App\Models\Data;
use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DataFactory extends Factory
{
    protected $model = Data::class;

    public function definition(): array
    {
        $fields = [
            'foreman_docs',
            'sanding_sample_lab',
            'data_validation',
            'internal_validation',
        ];

        $labels = [
            'foreman_docs' => 'Controllo documentazione fornita dal caposquadra',
            'sanding_sample_lab' => 'Spedizione campioni ai laboratori',
            'data_validation' => 'Avvio attività di analisi dati',
            'internal_validation' => 'Validazione interna degli elaborati prodotti',
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

            'data' => $this->faker->paragraph,
            'name_phase' => $labels[$trueField],

            'user' => fake()->name(),
            'status' => fake()->randomElement(['Svolto', 'In attesa']),
            'user_data' => User::factory(),
            'status_data' => $this->faker->randomElement(['pending', 'approved', 'rejected']),

            'foreman_docs' => $this->faker->sentence,
            'user_foreman_docs' => User::factory(),
            'status_foreman_docs' => $this->faker->randomElement(['pending', 'approved']),

            'sanding_sample_lab' => $this->faker->sentence,
            'user_sanding_sample_lab' => User::factory(),
            'status_sanding_sample_lab' => $this->faker->randomElement(['sent', 'processing', 'done']),

            'data_validation' => $this->faker->sentence,
            'user_data_validation' => User::factory(),
            'status_data_validation' => $this->faker->randomElement(['valid', 'invalid']),

            'internal_validation' => $this->faker->sentence,
            'user_internal_validation' => User::factory(),
            'status_internal_validation' => $this->faker->randomElement(['yes', 'no']),
        ];
    }
}