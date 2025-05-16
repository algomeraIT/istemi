<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityFactory extends Factory
{
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
        $userIds = User::pluck('id')->toArray();

        $status = ['nuovo', 'in attesa', 'completato', 'sospeso'];
        $randomStatus = fake()->randomElement($status);

        $expiration = now()->addDays(3);

        $complete = null;

        if ($randomStatus == 'completato') {
            $complete = now()->addDays(2);
        }

        return [
            'client_id' => fake()->randomElement($clientIds),
            'assigned_to' => fake()->randomElement($userIds),
            'title' => $this->faker->word,
            'note' => $this->faker->paragraph,
            'status' => fake()->randomElement($status),
            'expiration' => $expiration,
            'completed_at' => $complete,
            'created_by' => null,
            'updated_by' => null,
        ];
    }
}
