<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Phase;
use App\Models\Area;
use App\Models\MicroArea;
use App\Models\Project;
use App\Models\User;

class PhaseSeeder extends Seeder
{
    public function run(): void
    {
        $area = Area::first() ?? Area::factory()->create();
        $micro = MicroArea::first() ?? MicroArea::factory()->create();
        $project = Project::first() ?? Project::factory()->create();
        $user = User::first() ?? User::factory()->create();


        Phase::create([
            'id_area' => $area->id,
            'id_micro_area' => $micro->id,
            'id_project' => $project->id, 
            'id_user' => $user->id,
            'status' => 'In attesa',
        ]);
        Phase::factory()->count(20)->create();
    }
}