<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ConstructionSitePlane;

class ConstructionSitePlaneSeeder extends Seeder
{
    public function run(): void
    {
        ConstructionSitePlane::factory()->count(10)->create();
    }
}
