<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\DocumentProject;
use App\Models\Project;
class DocumentProjectFactory extends Factory
{
    protected $model = DocumentProject::class;

    public function definition(): array
    {
        return [
            'document_name' => $this->faker->words(3, true),
            'project_id' => \App\Models\Project::factory(), 
            'phase'         => $this->faker->randomElement([
                'Avvio', 'Pianificazione', 'Esecuzione', 'Verifica', 'Chiusura'
            ]),
            'user_id'       => \App\Models\User::factory(),      
            'user_name'     => $this->faker->name(),
            'status'        => $this->faker->randomElement(['loaded','deleted']),
            'created_at'    => now(),
            'updated_at'    => now(),
        ];
    }
}