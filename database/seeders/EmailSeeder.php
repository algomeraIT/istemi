<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Email;
use App\Models\Client;
use App\Models\HistoryClient;
use Illuminate\Database\Seeder;

class EmailSeeder extends Seeder
{
    public function run(): void
    {
        $userIds = User::pluck('id')->toArray();

        $clients = Client::where('status', 'contatto')->get();

        foreach ($clients as $client) {
            Email::factory()->count(10)->make()->each(function ($email) use ($userIds, $client) {
                $email->client_id  = $client->id;
                $email->created_by = fake()->randomElement($userIds);
                $email->updated_by = fake()->randomElement($userIds);
                $email->saveQuietly();

                HistoryClient::create([
                    'client_id' => $client->id,
                    'type'      => 'email',
                    'action'    => 'create',
                    'model_id'  => $email->id,
                    'status_client' => $client->step,
                ]);
            });
        }
    }
}
