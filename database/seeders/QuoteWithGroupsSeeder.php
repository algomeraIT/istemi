<?php

namespace Database\Seeders;

use App\Enums\MeasurementUnitEnum;
use App\Enums\QuoteStatusEnum;
use App\Models\Client;
use App\Models\GeneralTerm;
use App\Models\Issuer;
use App\Models\PriceList;
use App\Models\Product;
use App\Models\Quote;
use App\Models\QuoteItemGroup;
use App\Models\QuoteItem;
use App\Models\QuoteTemplate;
use App\Models\TaxRate;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class QuoteWithGroupsSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $faker = Faker::create('it_IT');

        // Assicuriamoci che esistano le dipendenze necessarie
        $this->ensureDependenciesExist($faker);

        // Ottieni le entità necessarie
        $issuer = Issuer::first();
        $client = Client::first();
        $priceList = PriceList::first();
        $quoteTemplate = QuoteTemplate::first();
        $taxRate = TaxRate::first();
        $generalTerm = GeneralTerm::first();
        $user = User::first();
        $products = Product::limit(10)->get();

        // Prepara tutti i general terms con il nome dell'issuer sostituito
        $allTerms = $this->getAllGeneralTermsWithIssuerName($issuer->name);

        // Crea la Quote
        $quote = Quote::create([
            'code' => 'PRV' . date('Y') . str_pad(rand(1, 999), 4, '0', STR_PAD_LEFT),
            'issuer_id' => $issuer->id,
            'client_id' => $client->id,
            'status' => QuoteStatusEnum::DRAFT,
            'due_date' => $faker->dateTimeBetween('+1 month', '+3 months')->format('Y-m-d'),
            'total' => 0, // Calcoleremo dopo
            'billing_country' => 'Italia',
            'billing_city' => $faker->city,
            'billing_province' => $faker->stateAbbr,
            'billing_address' => $faker->address,
            'delivery_country' => 'Italia',
            'delivery_city' => $faker->city,
            'delivery_province' => $faker->stateAbbr,
            'delivery_address' => $faker->address,
            'subject' => 'Preventivo per servizi di ingegneria e consulenza tecnica',
            'price_list_id' => $priceList->id,
            'quote_template_id' => $quoteTemplate->id,
            'terms' => json_encode([
                'general_terms' => $allTerms,
                'payment_terms' => '30 giorni data fattura',
                'delivery_terms' => 'Franco fabbrica'
            ]),
            'tax_rate_id' => $taxRate->id,
            'created_by' => $user->id,
        ]);

        $totalQuoteAmount = 0;

        // Crea 3 QuoteGroups
        for ($groupIndex = 1; $groupIndex <= 3; $groupIndex++) {
            $quoteGroup = QuoteItemGroup::create([
                'quote_id' => $quote->id,
                'sort_order' => $groupIndex,
            ]);

            $sortOrder = 1;
            $groupTotal = 0;

            // Crea 2 titoli per gruppo
            for ($titleIndex = 1; $titleIndex <= 2; $titleIndex++) {
                QuoteItem::create([
                    'quote_item_group_id' => $quoteGroup->id,
                    'type' => 'title',
                    'title' => $this->getGroupTitle($groupIndex, $titleIndex),
                    'note' => 'Sezione ' . $titleIndex . ' del gruppo ' . $groupIndex,
                    'quantity' => null,
                    'uom' => MeasurementUnitEnum::UNITA,
                    'unit_price' => 0,
                    'discount_pct' => 0,
                    'line_total' => 0,
                    'is_cnpaia' => false,
                    'sort_order' => $sortOrder++,
                ]);
            }

            // Crea 3 servizi (prodotti) per gruppo
            for ($serviceIndex = 1; $serviceIndex <= 3; $serviceIndex++) {
                $product = $products->random();
                $quantity = $faker->randomFloat(2, 1, 10);
                $unitPrice = $faker->randomFloat(2, 50, 500);
                $discountPct = $faker->numberBetween(0, 15);
                $lineTotal = ($quantity * $unitPrice) * (1 - $discountPct / 100);

                QuoteItem::create([
                    'product_id' => $product->id,
                    'quote_item_group_id' => $quoteGroup->id,
                    'type' => 'product',
                    'title' => $product->title,
                    'note' => $product->description,
                    'quantity' => $quantity,
                    'uom' => $product->uom,
                    'unit_price' => $unitPrice,
                    'discount_pct' => $discountPct,
                    'line_total' => $lineTotal,
                    'is_cnpaia' => $product->is_cnpaia,
                    'sort_order' => $sortOrder++,
                ]);

                $groupTotal += $lineTotal;
            }

            // Crea 2 note aggiuntive per gruppo
            for ($noteIndex = 1; $noteIndex <= 2; $noteIndex++) {
                QuoteItem::create([
                    'quote_item_group_id' => $quoteGroup->id,
                    'type' => 'note',
                    'title' => null,
                    'note' => $this->getGroupNote($groupIndex, $noteIndex),
                    'quantity' => null,
                    'uom' => MeasurementUnitEnum::UNITA,
                    'unit_price' => 0,
                    'discount_pct' => 0,
                    'line_total' => 0,
                    'is_cnpaia' => false,
                    'sort_order' => $sortOrder++,
                ]);
            }

            $totalQuoteAmount += $groupTotal;
        }

        // Aggiorna il totale della quote
        $quote->update(['total' => $totalQuoteAmount]);

        // Assegna alcuni utenti tecnici e di area alla quote
        $techUsers = User::limit(2)->get();
        $areaUsers = User::limit(2)->get();

        foreach ($techUsers as $techUser) {
            $quote->techUsers()->attach($techUser->id);
        }

        foreach ($areaUsers as $areaUser) {
            $quote->areaUsers()->attach($areaUser->id);
        }

        $this->command->info("Quote creata con successo: {$quote->code}");
        $this->command->info("Totale preventivo: €" . number_format($totalQuoteAmount, 2, ',', '.'));
    }

    /**
     * Assicura che esistano le dipendenze necessarie
     */
    private function ensureDependenciesExist($faker): void
    {
        // Crea Issuer se non esiste
        if (!Issuer::exists()) {
            Issuer::create([
                'name' => 'Studio Tecnico Associato Rossi & Partners',
                'address' => $faker->address,
                'vat' => 'IT' . $faker->numerify('###########'),
                'sdi_code' => strtoupper($faker->lexify('???????')),
                'fiscal_code' => strtoupper($faker->lexify('??????????????')),
                'currency' => 'EUR',
                'main_company' => 'Studio Tecnico Associato Rossi & Partners S.r.l.',
                'rea_number' => $faker->numerify('######'),
                'share_capital' => 50000.00,
            ]);
        }

        // Crea Client se non esiste
        if (!Client::exists()) {
            Client::factory()->create();
        }

        // Crea PriceList se non esiste
        if (!PriceList::exists()) {
            PriceList::create([
                'name' => 'Listino Standard Servizi Tecnici',
                'description' => 'Listino prezzi per servizi di ingegneria e consulenza tecnica',
            ]);
        }

        // Crea TaxRate se non esiste
        if (!TaxRate::exists()) {
            TaxRate::create([
                'name' => 'IVA 22%',
                'rate' => 22.00,
                'active' => true,
            ]);
        }

        // Crea GeneralTerm se non esiste
        if (!GeneralTerm::exists()) {
            GeneralTerm::create([
                'name' => 'Termini e Condizioni Generali',
                'text' => 'La {{issuer.name}} (di seguito definita anche Società) è società di ingegneria, è altresì Laboratorio Autorizzato ai sensi della Circolare 633/2019 del Consiglio Superiore dei Lavori Pubblici. Le attività commissionatele a mezzo del presente atto saranno condotte da personale tecnico qualificato. In particolare, le attività metriche laboratoriali oggetto di opportuna certificazione saranno eseguite sotto la guida di personale certificato all\'esecuzione di prove non distruttive ai sensi della normativa UNI 11931:2024, relativamente all\'ingegneria civile, ai beni culturali ed architettonici, nonché della UNI EN ISO 9712:2012 per il settore industriale.',
            ]);
        }

        // Crea QuoteTemplate se non esiste
        if (!QuoteTemplate::exists()) {
            $issuer = Issuer::first();
            $priceList = PriceList::first();

            QuoteTemplate::create([
                'name' => 'Template Standard Servizi Tecnici',
                'issuer_id' => $issuer->id,
                'price_list_id' => $priceList->id,
            ]);
        }

        // Crea User se non esiste
        if (!User::exists()) {
            User::factory()->create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
            ]);
        }

        // Crea Products se non esistono
        if (Product::count() < 10) {
            $this->createSampleProducts($faker);
        }
    }

    /**
     * Crea prodotti di esempio
     */
    private function createSampleProducts($faker): void
    {
        // Assicurati che esista almeno una ProductCategory
        if (!ProductCategory::exists()) {
            ProductCategory::create([
                'name' => 'Servizi di Ingegneria',
                'description' => 'Servizi professionali di ingegneria e consulenza tecnica',
            ]);
        }

        $category = ProductCategory::first();

        $products = [
            [
                'unique_code' => 'ING-001',
                'title' => 'Progettazione strutturale',
                'description' => 'Servizi di progettazione strutturale per edifici civili e industriali',
                'price' => 85.00,
                'uom' => MeasurementUnitEnum::WORKING_TIME,
                'is_cnpaia' => true,
            ],
            [
                'unique_code' => 'ING-002',
                'title' => 'Calcolo strutturale',
                'description' => 'Calcoli strutturali e verifica di stabilità',
                'price' => 75.00,
                'uom' => MeasurementUnitEnum::WORKING_TIME,
                'is_cnpaia' => true,
            ],
            [
                'unique_code' => 'ING-003',
                'title' => 'Direzione lavori',
                'description' => 'Servizi di direzione lavori e supervisione cantiere',
                'price' => 95.00,
                'uom' => MeasurementUnitEnum::WORKING_TIME,
                'is_cnpaia' => true,
            ],
            [
                'unique_code' => 'LAB-001',
                'title' => 'Prove non distruttive',
                'description' => 'Esecuzione di prove non distruttive su strutture',
                'price' => 120.00,
                'uom' => MeasurementUnitEnum::PER_ELEMENTO_INDAGATO,
                'is_cnpaia' => false,
            ],
            [
                'unique_code' => 'LAB-002',
                'title' => 'Rilievo geometrico',
                'description' => 'Rilievi geometrici e topografici',
                'price' => 65.00,
                'uom' => MeasurementUnitEnum::WORKING_TIME,
                'is_cnpaia' => true,
            ],
            [
                'unique_code' => 'CON-001',
                'title' => 'Consulenza tecnica',
                'description' => 'Consulenza tecnica specialistica',
                'price' => 110.00,
                'uom' => MeasurementUnitEnum::WORKING_TIME,
                'is_cnpaia' => true,
            ],
            [
                'unique_code' => 'REL-001',
                'title' => 'Relazione tecnica',
                'description' => 'Redazione di relazioni tecniche specialistiche',
                'price' => 350.00,
                'uom' => MeasurementUnitEnum::CAD,
                'is_cnpaia' => true,
            ],
            [
                'unique_code' => 'VER-001',
                'title' => 'Verifica sismica',
                'description' => 'Verifica di vulnerabilità sismica',
                'price' => 850.00,
                'uom' => MeasurementUnitEnum::A_CORPO,
                'is_cnpaia' => true,
            ],
            [
                'unique_code' => 'COL-001',
                'title' => 'Collaudo statico',
                'description' => 'Servizi di collaudo statico',
                'price' => 1200.00,
                'uom' => MeasurementUnitEnum::A_CORPO,
                'is_cnpaia' => true,
            ],
            [
                'unique_code' => 'DIS-001',
                'title' => 'Disegni tecnici',
                'description' => 'Elaborazione di disegni tecnici CAD',
                'price' => 45.00,
                'uom' => MeasurementUnitEnum::WORKING_TIME,
                'is_cnpaia' => false,
            ],
        ];

        foreach ($products as $productData) {
            Product::create(array_merge($productData, [
                'product_category_id' => $category->id,
                'is_active' => true,
            ]));
        }
    }

    /**
     * Ottieni tutti i general terms con il nome dell'issuer sostituito
     */
    private function getAllGeneralTermsWithIssuerName($issuerName): array
    {
        $generalTermsData = [
            [
                "id" => 20,
                "name" => "1.\tCONDIZIONI GENERALI",
                "text" => "La {{issuer.name}} (di seguito definita anche Società) è società di ingegneria, è altresì Laboratorio Autorizzato ai sensi della Circolare 633/2019 del Consiglio Superiore dei Lavori Pubblici. Le attività commissionatele a mezzo del presente atto saranno condotte da personale tecnico qualificato. In particolare, le attività metriche laboratoriali oggetto di opportuna certificazione saranno eseguite sotto la guida di personale certificato all'esecuzione di prove non distruttive ai sensi della normativa UNI 11931:2024, relativamente all'ingegneria civile, ai beni culturali ed architettonici, nonché della UNI EN ISO 9712:2012 per il settore industriale."
            ],
            [
                "id" => 21,
                "name" => "2.\tCONDIZIONI DI PAGAMENTO E FATTURAZIONE",
                "text" => "Il pagamento dei compensi e dei rimborsi, oltre all'IVA, se dovuta, e al contributo integrativo spettante alla CNPAIA - ai sensi della legge 3 gennaio 1981, n. 6 – avverrà con l'emissione della relativa fattura (divisa in voci di acconto e/o di saldo), nelle modalità riportate nei \"termini di pagamento\"."
            ],
            [
                "id" => 22,
                "name" => "3.\tMODALITA' DI PAGAMENTO E PENALITA'",
                "text" => "Il pagamento dei servizi previsti dal presente ordine dovrà essere effettuato come espressamente concordato alla voce Termini di pagamento. Nel caso in cui per ragioni tecnico/amministrative fosse anticipata al Committente una nota tecnica prima del saldo, la fattura di pagamento dovrà necessariamente essere corrisposta entro e non oltre 30 gg dalla sua emissione. In caso di ritardato pagamento della fattura di saldo protratto oltre 15 gg dal termine previsto, sarà applicata ipso iure una penale pari al 20% dell'importo totale, indicato sul presente documento. La stessa sarà oggetto di fattura diversa. Il Committente dichiara sin d'ora con il presente atto e la sottoscrizione dello stesso di accettare tale penalità e di non poter sottrarsi alla stessa se non con preventiva contestazione delle prestazioni rese dalla Società. Resta altresì pattuita la corresponsione di interessi moratori come per legge."
            ],
            [
                "id" => 23,
                "name" => "4.\tDURATA DELLA PRESTAZIONE E DECORRENZA DEL CONTRATTO",
                "text" => "Il contratto è una fornitura di servizi ed avrà inizio all'avvenuto pagamento dell'anticipo, ossia dalla data di bonifico dell'acconto, farà fede la data posta sulla contabile di bonifico. Nel caso in cui non venga previsto un anticipo, la fornitura di servizi avrà inizio dalla data di sottoscrizione del presente. Il servizio ha termine, salvo le condizioni di pagamento di cui al punto n. 3, con l'emissione di: a) relazione tecnica a firma di professionista abilitato, qualora trattasi di prestazione professionale o consulenziale oppure b) relazione tecnica con certificati e rapporti di prova a firma del Direttore di Laboratorio, qualora trattasi di prestazioni erogate ai sensi delle Circolare 633/2019. Tali documenti saranno trasmessi in formato digitale e saranno condivisibili per una durata di 6 mesi sul servizio di spazio cloud reso disponibile da Istemi. Solo su espressa richiesta della committenza, sarà inviata copia cartacea, previo pagamento delle spese di stampa e di spedizione. Per quanto concerne i tempi di erogazione del Servizio si rimanda ad opportune comunicazioni (a mezzo posta elettronica) da inviare a cura della Società all'atto della ricezione del presente contratto. Sarà possibile recedere dal presente contratto in qualsiasi momento e, comunque prima della consegna della Relazione Tecnica, presentando rinuncia motivata a mezzo PEC. Le prestazioni già svolte dovranno comunque essere liquidate alla Società."
            ],
            [
                "id" => 24,
                "name" => "5. SVOLGIMENTO DELL'INCARICO",
                "text" => "La Società svolgerà il proprio incarico avvalendosi di collaboratori, tanto autonomi che subordinati, i quali dipenderanno esclusivamente dalla Società, non intendendo il Committente avere alcun rapporto con essi. La Società è sollevata da ogni responsabilità per eventuali danni causati ad elementi di finitura (intonaci, paraspigoli, etc.) sulle parti oggetto dell'esecuzione delle prove e non dovuti ad imperizia del personale ma, solo alla normale procedura della prova stessa. Eventuali non conformità potranno essere oggetto di nota della committenza durante lo svolgimento delle indagini. Le aree oggetto di indagine devono essere accessibili e libere. In caso contrario eventuali operazioni di facchinaggio e trasporto saranno computate a parte. Nel caso in cui tali operazioni siano svolte da terzi, l''onere economico non ricadrà su questa Società. Analogamente, in presenza di eventuali maestranze edili in cantiere, ogni maggiore avere dovuto ad operazioni ausiliarie allo svolgimento delle indagini, non ricadrà su questa Società. L'area di prova deve essere resa fruibile e preparata, a cura della Committenza, per passaggio e gestione del personale addetto alla gestione dei sistemi di prelievo e misura. Le prove saranno localizzate su grafici forniti dalla Committenza in fase preliminare. Qualora ciò non avvenga, la Società è esonerata da eventuali non conformità tecnico-amministrative che dovessero generarsi. Sarà a carico della Committenza la preventiva valutazione della sicurezza dei luoghi con riferimento all'accessibilità delle aree e degli immobili interessati dai servizi ove la Società si troverà ad operare. Resta altresì, a cura della committenza la rimozione di impedimenti e la segnalazione dei pericoli connessi all'attività oggetto del presente contratto. Infine, sarà onere della committenza la valutazione di tutte le condizioni e di tutte le circostanze generali e particolari di luogo, suscettibili di influire sullo svolgimento delle prestazioni. La Committenza si impegna, salvo diversa pattuizione, nell'assistenza e fornitura di acqua e corrente elettrica per l'esecuzione delle indagini. Nel caso di indicazione di un referente tecnico della Committenza lo stesso si intende assuntore della definizione del piano delle indagini sopra riportate, fermo restando eventuali proposte migliorative avanzate dalla Società. È onere del referente tecnico la verifica dell'esecuzione delle prestazioni in situ. Qualora le attività di cantiere dovessero, su richiesta della Committenza, doversi tenere in giorni festivi o prefestivi e/o in orari notturni, si applicherà una maggiorazione pari al 10% dell'intero importo. Per quanto di competenza dei soggetti ex art. 59 comma 2, lettera a) e c)   del DPR 380/01, la Società provvederà con idoneo subappalto a propria cura."
            ],
            [
                "id" => 25,
                "name" => "6. CAMPIONI DI PROVA",
                "text" => "Ove la {{issuer.name}} non operi diretto campionamento in opera, il materiale da sottoporre ad analisi è recapitato alla Società a cura del Committente o di un suo incaricato. L'imballaggio, il trasporto e la consegna del campione sono sotto responsabilità del Committente. Il campione deve essere trasportato in modo tale da non subire variazioni di temperatura o di altri parametri chimico-fisici, che potrebbero inficiare il risultato analitico. Le analisi condotte dalla Società faranno sempre e comunque riferimento alla situazione del campione al momento della consegna (c.d. accettazione). Il Committente ha l'obbligo di informare la Società sui rischi inerenti al materiale da sottoporre ad analisi identificando i pericoli ad esso connessi. I campioni devono pervenire alla Società correttamente sigillati. La sigillatura deve essere fatta in modo da evitare qualsiasi possibilità di apertura, manomissione o rottura della sigillatura stessa o del campione da sottoporre a prova. Inoltre, occorre identificare in maniera leggibile (ad esempio riportando una sigla) ogni campione da sottoporre a prova, dal momento del prelievo a quello dell'inizio dell'iter analitico di Laboratorio. Il Committente ha, inoltre, l'obbligo di segnalare – salvo diverse disposizioni normative - la corretta modalità per la gestione dei campioni sottoposti a prova (eliminazione, restituzione, conservazione in laboratorio a lungo termine). La porzione di campione non utilizzato (di riserva), nonché la porzione di campione sottoposto ad analisi (campione residuo), saranno conservati esclusivamente per il periodo necessario allo svolgimento delle analisi e contestualmente alla emissione del Rapporto di Prova. Se non diversamente disposto dalla normativa o espressamente richiesto dalla Committenza, tali campioni verranno conservati, in relazione alla matrice e alla natura delle prove richieste, e comunque non oltre ad un periodo di 60 giorni a decorrere dall'emissione del Rapporto di Prova."
            ],
            [
                "id" => 26,
                "name" => "7. PROPRIETA' INTELLETTUALE",
                "text" => "I dati acquisiti e le immagini (foto e video) scattate e/o riprese effettuate nel corso di validità del contratto sono di proprietà esclusiva della società Istemi. Il materiale così acquisito può essere utilizzato, senza limiti di tempo, ai sensi degli artt. 10 e 320 cod. civ. e degli artt. 96 e 97 legge 22.4.1941, n. 633, (Legge sul diritto d'autore), per la pubblicazione e/o diffusione in qualsiasi forma attraverso tutti i canali di comunicazione societaria della {{issuer.name}} Gli stessi dati e le stesse immagini (foto e video) saranno adeguatamente conservati negli archivi informatici della Società. Tutto il materiale raccolto potrà essere utilizzato per pubblicazioni di carattere scientifico, informativo, culturale e promozionale. La Committenza non avrà nulla a pretendere dalle attività di cui al presente articolo."
            ],
            [
                "id" => 27,
                "name" => "8. CONTROVERSIE",
                "text" => "Il presente ordine costituisce Contratto ed è retto dalle Leggi Italiane. Se una qualsiasi clausola del presente contratto dovesse essere invalidata o resa inapplicabile in forza di provvedimenti di legge o giudiziali, il resto del contratto rimarrà in vigore. Tutte le controversie relative all'interpretazione e/o esecuzione del presente atto sono di competenza esclusiva del Tribunale di Nocera Inferiore (SA), qualora rientranti nella competenza del Tribunale, o, qualora di importo rientrante nella competenza del Giudice di Pace, del Giudice di Pace di Mercato San Severino (SA)."
            ],
            [
                "id" => 28,
                "name" => "9. DICHIARAZIONE TRA LE PARTI",
                "text" => "La Società dichiara di non trovarsi per l'espletamento dell'incarico, in alcuna condizione di incompatibilità ai sensi delle disposizioni di legge o contrattuali e si impegna espressamente all'osservanza dell'art. 14 della legge 6 agosto 1967, n. 765, di esecuzione delle prestazioni sono congruamente prorogati in caso di forza maggiore (avverse condizioni meteo, modifiche al piano delle indagini, imprevisti, etc.) o altri motivi ritenuti validi dal Committente o per l'entrata in vigore di norme di legge posteriormente alla firma del presente ordine. Per quanto non espressamente convenuto, le parti fanno riferimento alla Tariffa professionale."
            ],
            [
                "id" => 29,
                "name" => "10. DIVIETI",
                "text" => "È fatto espresso divieto al Committente di utilizzare direttamente la denominazione della Società, nonché dei marchi da lei detenuti, per qualsiasi altro scopo diverso da quello convenuto con il presente atto. La Società può cedere a terzi i crediti derivanti alla stessa dal presente contratto ma, tale cessione, è subordinata all'accettazione espressa da parte del Committente."
            ],
            [
                "id" => 30,
                "name" => "11. TRATTATIVE E MODIFICHE",
                "text" => "Il mancato esercizio dei diritti derivati dal presente contratto non costituirà, né potrà essere considerato, una rinuncia a tali diritti. Se una qualsiasi clausola del presente contratto dovesse essere invalidata o resa inapplicabile in forza di provvedimenti di legge o giudiziali, il resto del contratto rimarrà in vigore. Le parti dichiarano che il testo del presente contratto consta di n. 15 articoli, ed è stato oggetto di articolata trattativa, avendone la stessa esaminata e discussa in ogni singola clausola, ben consapevoli delle reciproche obbligazioni e soggezioni, nonché dei reciproci diritti. Esso, pertanto, è il frutto di specifiche trattative e rispecchia in pieno il voluto delle parti. Eventuali modifiche al presente contratto, potranno essere effettuate, previo accordo fra le Parti, solo tramite stesura di apposite modifiche scritte. Il Contratto contiene integralmente l'accordo intervenuto tra le parti e sostituisce ogni precedente accordo, comunicazione, trattativa o intesa eventualmente intercorse tra le medesime, sia per iscritto che in altra forma. Il Contratto non viene esposto a registrazione per espressa volontà delle parti, restando stabilito che, ove ciò si rendesse necessario, tutte le spese cederanno a carico della parte inadempiente e che con il proprio comportamento ne avrà reso necessaria la produzione in giudizio."
            ],
            [
                "id" => 31,
                "name" => "12. COPERTURA ASSICURATIVA",
                "text" => "Si dà atto che la Società, conformemente alle normative vigenti, ha stipulato con la compagnia Arch Insurance (EU) DAC, una Polizza di Assicurazione Responsabilità Civile multirischi professionale RTC/RCO mostrata ed accettata con la firma del presente atto."
            ],
            [
                "id" => 32,
                "name" => "13. RISPETTO DEGLI STANDARD QUALITATIVI (ISO 9001)",
                "text" => "Le attività svolte dalla Società saranno erogate nel rispetto di standard qualitativi basati sulla normativa ISO 9001 e successivi aggiornamenti per assicurare al Committente un adeguato livello di qualità della propria prestazione."
            ],
            [
                "id" => 33,
                "name" => "14. NORMATIVA APPLICABILE IN MATERIA DI SICUREZZA E SALUTE SUI LUOGHI DI LAVORO",
                "text" => "Durante l''esecuzione delle prestazioni il Contraente garantisce il pieno rispetto da parte propria e del personale impiegato, inclusi i subappaltatori e il personale dei subappaltatori, della normativa vigente in Italia in materia di sicurezza e salute sui luoghi di lavoro. In particolare, in caso di prestazioni non eseguite nell''ambito di un cantiere, si applicano il D.Lgs. 81/08, Titolo I, Capo III, Sezione II e successive modifiche ed integrazioni, nonché le norme cui esso rinvia. In caso di prestazioni eseguite nell''ambito di un cantiere si applica il D.Lgs. 81/08, Titolo IV e successive modifiche ed integrazioni, nonché le norme cui esso rinvia. Le attività svolte dalla Società saranno erogate nel rispetto di standard qualitativi basati sulla normativa ISO 45001 e successivi aggiornamenti per assicurare al Committente un adeguato livello di sicurezza della propria prestazione."
            ],
            [
                "id" => 34,
                "name" => "15. NORME DI RINVIO",
                "text" => "Per quanto non espressamente previsto, ci si riporta alle norme vigenti in materia e, in mancanza, agli usi ed all'equità, purché non in contrasto con le norme di questo atto."
            ],
            [
                "id" => 65,
                "name" => "16. REVISIONI ED EMENDAMENTI",
                "text" => "Il Committente con la sottoscrizione del presente contratto dichiara di accettare tutto quanto risulta esplicitato nello stesso e negli allegati - qualora presenti -, così come dichiara di accettare che i servizi saranno svolti secondo quanto dettagliato alla voce \"B. DESCRIZIONE E MODALITA'' DI ESECUZIONE DELLE PRESTAZIONI\". Eventuali richieste di modifiche della modalità di svolgimento dei servizi così come normati nel presente contratto o dei loro parametri normativi e/o regolamentari, quali i capitolati applicati, dovranno essere avanzate prima dell'inizio delle attività. Viceversa, se la richiesta di modifiche dovesse avvenire a seguito dell'accettazione del presente e/o a seguito dell'inizio delle attività, esse saranno oggetto di nuova valutazione economica. Il Contratto non viene assoggettato a registrazione per espressa volontà delle parti, restando stabilito che, ove ciò si rendesse necessario, tutte le spese saranno ad esclusivo carico della parte inadempiente, la quale a causa del comportamento tenuto ne renderà necessaria la produzione in giudizio."
            ],
            [
                "id" => 66,
                "name" => "17. SCONTI",
                "text" => "Gli sconti, ove previsti alla tabella di cui al punto A del presente documento, saranno applicati unicamente a condizione che tutte le prestazioni e le attività ivi indicate siano eseguite integralmente e nei termini concordati. Qualora una o più delle attività previste non vengano completamente eseguite in forza di una inesatta stima e progettazione del piano delle indagini, lo sconto non sarà applicabile e l''importo complessivo dovuto resterà invariato, senza alcuna riduzione. In alternativa, l''importo sarà oggetto di rinegoziazione."
            ]
        ];

        // Sostituisci tutti i placeholder {{issuer.name}} con il nome effettivo dell'issuer
        return array_map(function ($term) use ($issuerName) {
            return [
                'id' => $term['id'],
                'name' => $term['name'],
                'text' => str_replace('{{issuer.name}}', $issuerName, $term['text'])
            ];
        }, $generalTermsData);
    }

    /**
     * Genera titoli per i gruppi
     */
    private function getGroupTitle($groupIndex, $titleIndex): string
    {
        $titles = [
            1 => [
                1 => 'SERVIZI DI PROGETTAZIONE STRUTTURALE',
                2 => 'CALCOLI E VERIFICHE STRUTTURALI',
            ],
            2 => [
                1 => 'PROVE DI LABORATORIO',
                2 => 'INDAGINI DIAGNOSTICHE',
            ],
            3 => [
                1 => 'SERVIZI DI CONSULENZA TECNICA',
                2 => 'COLLAUDI E CERTIFICAZIONI',
            ],
        ];

        return $titles[$groupIndex][$titleIndex] ?? "TITOLO GRUPPO $groupIndex - $titleIndex";
    }

    /**
     * Genera note per i gruppi
     */
    private function getGroupNote($groupIndex, $noteIndex): string
    {
        $notes = [
            1 => [
                1 => 'Tutti i servizi di progettazione saranno eseguiti secondo le normative tecniche vigenti (NTC 2018 e relative circolari applicative).',
                2 => 'Le verifiche strutturali includeranno analisi statiche e dinamiche con software certificati.',
            ],
            2 => [
                1 => 'Le prove di laboratorio saranno eseguite secondo le normative UNI EN di riferimento.',
                2 => 'Tutti i rapporti di prova saranno firmati da tecnici qualificati e certificati.',
            ],
            3 => [
                1 => 'I servizi di consulenza includono sopralluoghi, analisi documentale e redazione di relazioni tecniche.',
                2 => 'I collaudi saranno eseguiti secondo le procedure previste dal D.M. 14 gennaio 2008.',
            ],
        ];

        return $notes[$groupIndex][$noteIndex] ?? "Nota tecnica per il gruppo $groupIndex, elemento $noteIndex";
    }
}