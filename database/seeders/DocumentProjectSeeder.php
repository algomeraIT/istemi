<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\DocumentProject;



class DocumentProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::all()->each(function ($project) {
            DocumentProject::factory()->count(5)->create([
                'project_id' => $project->id,
            ]);
        });
    }
}
