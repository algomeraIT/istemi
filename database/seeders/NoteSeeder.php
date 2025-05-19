<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\User;
use App\Models\Client;
use App\Models\HistoryClient;
use Illuminate\Database\Seeder;

class NoteSeeder extends Seeder
{
    public function run(): void
    {
        $userIds = User::pluck('id')->toArray();

        $clients = Client::where('status', 'contatto')->get();

        foreach ($clients as $client) {
            Note::factory()->count(10)->make()->each(function ($note) use ($userIds, $client) {
                $note->client_id  = $client->id;
                $note->created_by = fake()->randomElement($userIds);
                $note->updated_by = fake()->randomElement($userIds);
                $note->saveQuietly();

                HistoryClient::create([
                    'client_id' => $client->id,
                    'type'      => 'note',
                    'action'    => 'create',
                    'model_id'  => $note->id,
                    'status_client' => $client->step,
                ]);
            });
        }
    }
}
