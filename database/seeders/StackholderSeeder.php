<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Stackholder;

class StackholderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Stackholder::factory()->count(20)->create();

    }
}
