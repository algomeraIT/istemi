<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Issuer;

class IssuersSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('seeders/data/issuers.json');
        if (! File::exists($path)) {
            $this->command->error("File non trovato: {$path}");
            return;
        }

        $items = json_decode(File::get($path), true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->command->error("JSON invalido in issuers.json: " . json_last_error_msg());
            return;
        }

        foreach ($items as $item) {
            Issuer::updateOrCreate(
                ['id' => $item['id']],
                [
                    'name'            => $item['display_name'] ?? $item['name'],
                    'address'         => trim(
                        ($item['street'] ?? '') . ' ' .
                        ($item['street2'] ?? '') . ', ' .
                        ($item['zip'] ?? '') . ' ' .
                        ($item['city'] ?? '') .
                        ($item['country_id'] ? ' (' . $item['country_id'] . ')' : '')
                    ),
                    'vat'             => $item['vat'] ?? null,
                    'sdi_code'        => $item['codice_destinatario'] ?? null,
                    'fiscal_code'     => $item['fiscalcode'] ?? null,
                    'currency'        => $item['currency'] ?? 'EUR',
                    'main_company'    => $item['commercial_company_name'] ?? null,
                    'rea_number'      => $item['rea_code'] ?? null,
                    'share_capital'   => isset($item['rea_capital'])
                        ? (float) str_replace(',', '.', $item['rea_capital'])
                        : null,
                ]
            );
        }

        $this->command->info('Issuers seeded: ' . count($items));
    }
}
