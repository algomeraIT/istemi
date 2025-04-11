<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NoteCommunicationClient;

class NoteCommunicationClientSeeder extends Seeder
{
    public function run(): void
    {
        NoteCommunicationClient::factory()->count(30)->create();
    }
}