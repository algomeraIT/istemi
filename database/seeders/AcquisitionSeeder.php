<?php

namespace Database\Seeders;

use App\Models\Acquisition;
use Illuminate\Database\Seeder;

class AcquisitionSeeder extends Seeder
{
    public function run(): void
    {
        Acquisition::factory()->count(30)->create();
    }
}
