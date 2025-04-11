<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NoteProject;

class NoteProjectSeeder extends Seeder {
    public function run() {
        NoteProject::factory()->count(30)->create();
    }
}
