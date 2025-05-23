<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Area;
use App\Models\MicroArea;

class MicroAreaSeeder extends Seeder
{
    public function run(): void
    {
        $areaMicroMap = [
            'Avvio progetto' => [
                'Verifica contratto',
                "Verifica CME - Piano d'indagine e capitolato",
                'Riserve',
                'Impostare la data di scadenza del progetto',
                'Definizione del piano di comunicazione',
                'Proroga',
                'Possibilità di produrre dei SAL',
                'Garanzia definitiva',
            ],
            'Fattura e acconto SAL' => [
                'Emissione fattura',
                'Pagamento fattura',
            ],
            'Pianificazione cantiere' => [
                'Verifica accesibilità e sopralluogo',
                'Organizzazione trasferte',
                'Permessi/pass accesso al sito',
                'Permessi/pass ZTL',
                'Selezione fornitori',
                'Cronoprogramma',
                'Sicurezza',
            ],
            'Esecuzione attività' => [
                'Selezione della squadra (caposquadra + altre risorse)',
                'Indicazioni per lo svolgimento delle attività in campo',
                'Riepilogo giornaliero delle attività',
                'Caricamento dati di cantiere',
                'Controllo avanzamento attività/budget (PM)',
            ],
            'Elaborazione dati' => [
                'Controllo documentazione Caposquadra',
                'Spedizione campione ai laboratori',
                'Avvio analisi dati',
                'Validazione interna elaborati',
            ],
            'Trasmissione report' => [
                'Predisposizione nota di trasmissione',
                'Invio nota di trasmissione',
            ],
            'Contabilità' => [
                'Contabilità attività eseguite (DEC)',
                'Produrre richiesta CRE',
                'Riparto spese',
            ],
            'Verifica esterna' => [
                'CRE',
                'Liquidazione',
                'Predisposizione della fattura di saldo',
            ],
            'Verifica tecnico contabile' => [
                'Saldo',
                'Archiviazione CRE',
                'Pagamento fornitori',
                'Pagamento riparto spese',
                'Lezioni apprese',
            ],
            'Gestione non conformità' => [
                'Accogliere richieste della S.A.',
                'Inviare documentazione integrativa',
            ],
            'Chiusura attività' => [
                'Fatturato specifico',
                'Svincolo della polizza',
            ],
        ];

        foreach ($areaMicroMap as $areaName => $microNames) {
            $area = Area::firstOrCreate(['name' => $areaName]);

            foreach ($microNames as $microName) {
                MicroArea::updateOrCreate(
                    ['name' => $microName],
                    ['area_id' => $area->id]
                );
            }
        }
    }
}