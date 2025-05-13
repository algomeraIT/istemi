<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\NoteTaskProjectStart;


class NoteTaskProjectStartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NoteTaskProjectStart::factory()->count(10)->create();
    }
}
