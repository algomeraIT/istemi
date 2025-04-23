<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmailCommunicationClientHistory;

class EmailCommunicationClientHistorySeeder extends Seeder
{
    public function run(): void
    {
        EmailCommunicationClientHistory::factory()->count(1)->fixed()->create();

        EmailCommunicationClientHistory::factory()->count(30)->create();
    }
}
