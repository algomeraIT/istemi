<?php

namespace Database\Seeders;

use App\Models\NoteProject;
use Illuminate\Database\Seeder;

class NoteProjectSeeder extends Seeder
{
    public function run()
    {
        NoteProject::factory()->count(20)->create();
    }
}
