<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Area;

class AreaSeeder extends Seeder
{
    public function run(): void
    {
        $names = [
            'Avvio progetto',
            'Fattura e acconto SAL',
            'Pianificazione cantiere',
            'Esecuzione attività',
            'Elaborazione dati',
            'Trasmissione report',
            'Contabilità',
            'Verifica esterna',
            'Verifica tecnico contabile',
            'Gestione non conformità',
            'Chiusura attività'
        ];

        foreach ($names as $name) {
            Area::firstOrCreate(['name' => $name]);
        }
    }
}