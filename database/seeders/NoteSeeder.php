<?php

namespace Database\Seeders;

use App\Models\Note;
use Illuminate\Database\Seeder;

class NoteSeeder extends Seeder
{
    protected $table = 'notes';

    public function run(): void
    {
        Note::factory()->count(10)->create();
    }
}
