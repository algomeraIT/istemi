<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Client;
use App\Models\Project;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ActivityPhaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fields = [
            'team',
            'field_activities',
            'daily_check_activities',
            'contruction_site_media',
            'activity_validation',
        ];

        $labels = [
            'team' => 'Selezione della squadra',
            'field_activities' => 'Imprtire istruzioni utili allo svolgimento delle attività in campo',
            'daily_check_activities' => 'Riepilogo giornaliero delle attività eseguite',
            'contruction_site_media' => 'Caricamento dati cantiere',
            'activity_validation' => 'Controllo avanzamento attività/budget (PM)',
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

            'activities' => $this->faker->boolean,
            'name_phase' => $labels[$trueField],

            'user' => fake()->name(),
            'status' => fake()->randomElement(['Svolto', 'In attesa']),
            'user_activities' => User::factory(),
            'status_activities' => $this->faker->randomElement(['pending', 'completed']),

            'team' => $this->faker->boolean,
            'user_team' => User::factory(),
            'status_team' => $this->faker->randomElement(['ok', 'pending']),

            'field_activities' => $this->faker->boolean,
            'user_field_activities' => User::factory(),
            'status_field_activities' => $this->faker->randomElement(['ok', 'pending']),

            'daily_check_activities' => $this->faker->boolean,
            'user_daily_check_activities' => User::factory(),
            'status_daily_check_activities' => $this->faker->randomElement(['ok', 'pending']),

            'contruction_site_media' => $this->faker->boolean,
            'user_contruction_site_media' => User::factory(),
            'status_contruction_site_media' => $this->faker->randomElement(['ok', 'pending']),

            'activity_validation' => $this->faker->boolean,
            'user_activity_validation' => User::factory(),
            'status_activity_validation' => $this->faker->randomElement(['ok', 'pending']),
        ];
    }
}
