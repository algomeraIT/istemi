<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MicroArea;

class MicroAreaSeeder extends Seeder
{
    public function run(): void
    {
        $names = [
            'Verifica contratto',
            "Verifica CME - Piano d'indagine e capitolato",
            'Riserve',
            'Impostare la data di scadenza del progetto',
            'Definizione del piano di comunicazione',
            'Proroga',
            'Possibilità di produrre dei SAL',
            'Garanzia definitiva',
            'Emissione fattura',
            'Pagamento fattura',
            'Verifica accesibilità e sopralluogo',
            'Organizzazione trasferte',
            'Permessi/pass accesso al sito',
            'Permessi/pass ZTL',
            'Selezione fornitori',
            'Cronoprogramma',
            'Sicurezza',
            'Selezione della squadra (caposquadra + altre risorse)',
            'Indicazioni per lo svolgimento delle attività in campo',
            'Riepilogo giornaliero delle attività',
            'Caricamento dati di cantiere',
            'Controllo avanzamento attività/budget (PM)',
            'Controllo documentazione Caposquadra',
            'Spedizione campione ai laboratori',
            'Avvio analisi dati',
            'Validazione interna elaborati',
            'Predisposizione nota di trasmissione',
            'Invio nota di trasmissione',
            'Contabilità attività eseguite (DEC)',
            'Produrre richiesta CRE',
            'Riparto spese',
            'CRE',
            'Liquidazione',
            'Fattura di saldo',
            'Saldo',
            'Archiviazione CRE',
            'Pagamento fornitori',
            'Pagamento riparto spese',
            'Lezioni apprese',
            'Accogliere richieste della S.A.',
            'Inviare documentazione integrativa',
            'Fatturato specifico',
            'Svincolo della polizza',
        ];

        foreach ($names as $name) {
            MicroArea::create(['name' => $name]);
        }
    }
}