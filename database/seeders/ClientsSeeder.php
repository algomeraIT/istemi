<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientsSeeder extends Seeder
{
    public function run(): void
    {
        $userIds = User::pluck('id')->toArray();

        foreach (['lead', 'contatto', 'cliente'] as $status) {
            Client::factory()->count(20)->withStatus($status)->make()->each(function ($client) use ($userIds) {
                $client->created_by = fake()->randomElement($userIds);
                $client->updated_by = fake()->randomElement($userIds);
                $client->saveQuietly();
            });
        }
    }
}
