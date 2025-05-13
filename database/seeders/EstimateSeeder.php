<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estimate;

class EstimateSeeder extends Seeder
{
    public function run(): void
    {
        Estimate::factory()->count(1)->fixed()->create();

        Estimate::factory()->count(20)->create();
    }
}
