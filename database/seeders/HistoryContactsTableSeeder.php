<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HistoryContact;

class HistoryContactsTableSeeder extends Seeder
{
    public function run()
    {
        HistoryContact::factory()
            ->count(50)
            ->create();
    }
}