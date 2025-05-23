<?php

namespace Database\Seeders;

use App\Models\Call;
use App\Models\User;
use App\Models\Client;
use App\Models\HistoryClient;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::pluck('id')->toArray();

        $clients = Client::whereIn('status', ['contatto', 'cliente'])->get();

        foreach ($clients as $client) {
            Call::factory()->count(10)->make()->each(function ($call) use ($userIds, $client) {
                $call->client_id  = $client->id;
                $call->created_by = fake()->randomElement($userIds);
                $call->updated_by = fake()->randomElement($userIds);
                $call->saveQuietly();

                HistoryClient::create([
                    'client_id' => $client->id,
                    'type'      => 'call',
                    'action'    => 'create',
                    'model_id'  => $call->id,
                    'status_client' => $client->step,
                ]);
            });
        }
    }
}
