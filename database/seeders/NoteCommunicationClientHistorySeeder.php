<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NoteCommunicationClientHistory;

class NoteCommunicationClientHistorySeeder extends Seeder
{
    public function run(): void
    {
        NoteCommunicationClientHistory::factory()->count(1)->fixed()->create();

        NoteCommunicationClientHistory::factory()->count(30)->create();
    }
}
