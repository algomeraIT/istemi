<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Client;
use App\Models\HistoryClient;
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

                HistoryClient::create([
                    'client_id' => $client->id,
                    'type'      => 'client',
                    'action'    => 'create',
                    'model_id'  => $client->id,
                    'status_client' => $client->step,
                ]);
            });
        }
    }
}
