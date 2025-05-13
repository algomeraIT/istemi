<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sale;

class SaleSeeder extends Seeder
{
    public function run(): void
    {
        Sale::factory()->count(1)->fixed()->create();

        Sale::factory()->count(20)->create();
    }
}
