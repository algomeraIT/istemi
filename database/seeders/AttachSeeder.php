<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attach;

class AttachSeeder extends Seeder
{
    public function run(): void
    {
        Attach::factory()->count(30)->create();
    }
}
