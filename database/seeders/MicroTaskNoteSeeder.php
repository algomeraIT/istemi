<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MicroTaskNoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\MicroTaskNote::factory()->count(10)->create();

    }
}
