<?php

namespace Database\Factories;

use App\Models\DocumentProject;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentProjectFactory extends Factory
{
    protected $model = DocumentProject::class;

    public function definition(): array
    {
        return [
            'document_name' => $this->faker->words(3, true),
            'phase' => $this->faker->randomElement([
                'Avvio progetto',
                'Fatture e acconto SAL',
                'Elaborazione dati',
                'Trasmissione report',
                'Contabilità',
                'Verifica esterna',
                'Verifica tecnico contabile',
                'Gestione non conformità',
                'Chiusura attività',
            ]),
            'user_id' => \App\Models\User::inRandomOrder()->value('id'),
            'user_name' => $this->faker->name(),
            'status' => $this->faker->randomElement(['loaded', 'deleted']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
