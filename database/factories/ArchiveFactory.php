<?php

namespace Database\Factories;

use App\Models\Archive;
use App\Models\Project;
use App\Models\Clients;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArchiveFactory extends Factory
{
    protected $model = Archive::class;

    public function definition(): array
    {
        return [
            'project_id' => Project::factory(),
            'last_phase' => $this->faker->word,
            'note_project' => $this->faker->optional()->text,
            'estimate_project' => $this->faker->word,
            'id_client' => Clients::factory(), 
            'name_client' => $this->faker->company,
            'logo_path_client' => $this->faker->optional()->imageUrl(),
            'note_client' => $this->faker->optional()->text,
            'address_client' => $this->faker->address,
            'status' => $this->faker->randomElement([1, 0]), 
        ];
    }
}
