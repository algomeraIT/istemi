<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Clients;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Stackholder;
use App\Models\Phase;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        return [
                'general_info' => $this->faker->paragraph(),
                'n_file' => $this->faker->unique()->numerify('PRT-########'),
                'name_project' => $this->faker->sentence(3),
                'id_client' => Clients::factory(), 
                'client_name' => $this->faker->company,
                'logo_path_client' => $this->faker->imageUrl(),
                'client_type' => $this->faker->randomElement(['Privato', 'Pubblico']),
                'note_client' => $this->faker->paragraph(),
                'address_client' => $this->faker->address(),
                'client_status' => $this->faker->randomElement(['Active', 'Inactive']),
                'is_from_agent' => $this->faker->boolean(),
                'total_budget' => $this->faker->randomFloat(2, 50000, 1000000),
                'chief_area' => $this->faker->name(),
                'responsible' => $this->faker->name(),
                'chief_project' => $this->faker->name(),
                'start_at' => $this->faker->dateTimeBetween('-1 year', '+1 year'),
                'end_at' => $this->faker->dateTimeBetween('+1 month', '+2 years'),
                'starting_price' => $this->faker->randomFloat(2, 10000, 500000),
                'discount_percentage' => $this->faker->randomFloat(2, 0, 20),
                'discounted' => fn ($attrs) => $attrs['starting_price'] * (1 - ($attrs['discount_percentage'] / 100)),
                'n_firms' => $this->faker->numberBetween(1, 10),
                'firms_and_percentage' => json_encode([
                    'Azienda 1' => 50,
                    'Azienda 2' => 30,
                    'Azienda 3' => 20,
                ]),
                'note' => $this->faker->text(),
                'is_archived' => $this->faker->boolean(),
                'status' => $this->faker->randomElement([0, 1, 2]),
                'goals' => $this->faker->paragraph(),
                'project_scope' => $this->faker->paragraph(),
                'expected_results' => $this->faker->paragraph(),
                'stackholder_id' => Stackholder::factory(),
                'phase_id' => Phase::factory()->create()->id,
                'phase' => '',
                'current_phase' => $this->faker->randomElement(['Non definito', 'Avvio', 'Pianificazione', 'Esecuzione', 'Verifica', 'Chiusura']),
                'estimate' => $this->faker->randomElement(['Prima Stima', 'Seconda Stima']),
            ];
    }
}
