<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Archive;

class ArchiveSeeder extends Seeder
{
    public function run(): void
    {
        Archive::factory()->count(30)->create();
    }
}
