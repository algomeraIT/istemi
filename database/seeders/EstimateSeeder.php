<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estimate;

class EstimateSeeder extends Seeder
{
    public function run(): void
    {
        Estimate::factory()->count(30)->create();
    }
}
