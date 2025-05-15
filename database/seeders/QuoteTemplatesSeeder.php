<?php

namespace Database\Seeders;

use App\Enums\MeasurementUnitEnum;
use App\Models\Issuer;
use App\Models\Product;
use App\Models\QuoteTemplate;
use Illuminate\Database\Seeder;

class QuoteTemplatesSeeder extends Seeder
{
    public function run(): void
    {
        // 1) Trova l'issuer Istemi srl
        $issuer = Issuer::where('name', 'ISTEMI srl')->firstOrFail();

        // 2) Crea o aggiorna il template
        $template = QuoteTemplate::updateOrCreate(
            ['name' => 'Mod. 1 - Standard', 'issuer_id' => $issuer->id],
            ['price_list_id' => null] // o id del tuo price list se esiste
        );

        // 3) Cancella eventuali linee esistenti per ricrearle
        $template->lines()->delete();

        // 4) Prepara le righe da inserire
        $lines = [
            // RIGA PRODOTTO
            [
                'type'          => 'product',
                'product_id'    => Product::where('unique_code','APPR00')->value('id'),
                'description'   => 'Approntamento, installazione cantiere e oneri per la sicurezza',
                'quantity'      => 1,
                'uom'        => MeasurementUnitEnum::A_CORPO->value,
                'sort_order'    => 1,
            ],
            // RIGA TESTO 1
            [
                'type'        => 'text',
                'description' => 'L’importo si intende Iva esclusa. La voce RT00 è da intendersi oltre IVA e CNPAIA.',
                'sort_order'  => 2,
            ],
            // RIGA TESTO 2
            [
                'type'        => 'text',
                'description' => 'Termini di pagamento: Il presente preventivo ha validità 60gg data emissione.',
                'sort_order'  => 3,
            ],
            // RIGA TESTO 3
            [
                'type'        => 'text',
                'description' => 'Qualora la committenza desideri ricevere file in formato .rcp, .lgs, .rvt, .ifc, si addizionerà, a consuntivo, il costo dello strumento hardware di condivisione.',
                'sort_order'  => 4,
            ],
        ];

        // 5) Inserisci le righe
        foreach ($lines as $data) {
            $template->lines()->create($data);
        }

        $this->command->info("Quote Template '{$template->name}' seeded with ".count($lines)." lines.");
    }
}
