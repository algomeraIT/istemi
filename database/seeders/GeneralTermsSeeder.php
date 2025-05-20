<?php

namespace Database\Seeders;

use App\Models\GeneralTerm;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class GeneralTermsSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('seeders/data/general_terms.json');
        if (! File::exists($path)) {
            $this->command->error("File not found: {$path}");
            return;
        }

        $items = json_decode(File::get($path), true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->command->error("JSON error: " . json_last_error_msg());
            return;
        }

        foreach ($items as $item) {

            // sostituisci il nome specifico con un placeholder unico
            $text = str_replace(
                ['Istemi s.r.l.', 'ISTEMI s.r.l.', 'Materica Lab s.r.l.', 'Materica Lab srl', 'Istemi srl'],
                ['{{issuer.name}}',   '{{issuer.name}}',   '{{issuer.name}}', '{{issuer.name}}',   '{{issuer.name}}'],
                $item['text']
            );

            GeneralTerm::updateOrCreate(
                ['id' => $item['id']],
                [
                    'name'      => trim($item['name']),
                    'text'      => trim($text),
                ]
            );
        }

        $this->command->info("Seeded " . count($items) . " general terms.");
    }
}
