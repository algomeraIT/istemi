<?php

namespace Database\Seeders;

use App\Models\Acquisition;
use Illuminate\Database\Seeder;

class AcquisitionSeeder extends Seeder
{
    public function run(): void
    {
        Acquisition::factory()->count(1)->fixed()->create();

        Acquisition::factory()->count(20)->create();
    }
}
