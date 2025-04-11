<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ActivityCommunicationClientHistory;

class ActivityCommunicationClientHistorySeeder extends Seeder
{
    public function run(): void
    {
        ActivityCommunicationClientHistory::factory()->count(30)->create();
    }
}
