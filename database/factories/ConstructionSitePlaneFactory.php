<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConstructionSitePlaneFactory extends Factory
{
    public function definition(): array
    {
        $fields = [
            'inspection',
            'travel',
            'site_pass',
            'ztl',
            'supplier',
            'timetable',
            'security',
        ];

        $labels = [
            'inspection' => 'Ispezione',
            'travel' => 'Trasferte',
            'site_pass' => 'Permessi/pass accesso al sito',
            'ztl' => 'Permessi/pass ZTL',
            'supplier' => 'Selezione fornitori',
            'timetable' => 'Cronoprogramma',
            'security' => 'Sicurezza',
        ];

        $trueField = $this->faker->randomElement($fields);

        $data = [];
        foreach ($fields as $field) {
            $data[$field] = $field === $trueField;
        }

        $project = Project::first();
        $client = Client::first();

        return [
            'client_id' => $client->id,
            'project_id' => $project->id,

            'construction_site_plane' => $this->faker->boolean,
            'name_phase' => $labels[$trueField],

            'user' => fake()->name(),
            'status' => fake()->randomElement(['Svolto', 'In attesa']),
            'user_construction_site_plane' => User::factory(),
            'status_construction_site_plane' => $this->faker->randomElement(['pending', 'completed']),

            'inspection' => $this->faker->boolean,
            'user_inspection' => User::factory(),
            'status_inspection' => $this->faker->randomElement(['ok', 'pending']),

            'travel' => $this->faker->boolean,
            'user_travel' => User::factory(),
            'status_travel' => $this->faker->randomElement(['ok', 'pending']),

            'site_pass' => $this->faker->boolean,
            'user_site_pass' => User::factory(),
            'status_site_pass' => $this->faker->randomElement(['ok', 'pending']),

            'ztl' => $this->faker->boolean,
            'user_ztl' => User::factory(),
            'status_ztl' => $this->faker->randomElement(['ok', 'pending']),

            'supplier' => $this->faker->boolean,
            'user_supplier' => User::factory(),
            'status_supplier' => $this->faker->randomElement(['ok', 'pending']),

            'timetable' => $this->faker->boolean,
            'user_timetable' => User::factory(),
            'status_timetable' => $this->faker->randomElement(['ok', 'pending']),

            'security' => $this->faker->boolean,
            'user_security' => User::factory(),
            'status_security' => $this->faker->randomElement(['ok', 'pending']),
        ];
    }
}
