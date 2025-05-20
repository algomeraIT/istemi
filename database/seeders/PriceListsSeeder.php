<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PriceListsSeeder extends Seeder
{
    public function run(): void
    {
        // Inserisci o aggiorna il listino
        DB::table('price_lists')->updateOrInsert(
            ['name' => 'Listino prezzi al pubblico'],
            ['updated_at' => now(), 'created_at' => now()]
        );

        $this->command->info('Price list seeded.');
    }
}
