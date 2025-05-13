<?php

namespace Database\Factories;

use App\Models\Archive;
use App\Models\Project;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArchiveFactory extends Factory
{
    protected $model = Archive::class;

    public function definition(): array
    {
        $clientIds = Client::pluck('id')->toArray();

        return [
            'project_id' => Project::factory(),
            'last_phase' => $this->faker->word,
            'note_project' => $this->faker->optional()->text,
            'estimate_project' => $this->faker->word,
            'id_client' => fake()->randomElement($clientIds), 
            'name_client' => $this->faker->company,
            'logo_path_client' => $this->faker->optional()->imageUrl(),
            'note_client' => $this->faker->optional()->text,
            'address_client' => $this->faker->address,
            'status' => $this->faker->randomElement([1, 0]), 
        ];
    }
}
