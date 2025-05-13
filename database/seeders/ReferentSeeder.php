<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Referent;

class ReferentSeeder extends Seeder
{
    public function run(): void
    {
        Referent::factory()->count(1)->fixed()->create();

        Referent::factory()->count(20)->create();
    }
}
