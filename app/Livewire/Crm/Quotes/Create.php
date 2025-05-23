<?php

namespace App\Livewire\Crm\Quotes;

use App\Livewire\Crm\Quotes\Forms\QuoteForm;
use App\Models\Client;
use App\Models\Issuer;
use App\Models\PriceList;
use App\Models\Product;
use App\Models\QuoteTemplate;
use App\Models\TaxRate;
use App\Models\User;
use Livewire\Component;
use Flux\Flux;

class Create extends Component
{
    public QuoteForm $form;

    // List data for dropdowns
    public $issuers = [];
    public $clients = [];
    public $price_lists = [];
    public $templates = [];
    public $users = [];
    public $products = [];

    // Totals calculation
    public $subtotal = 0;
    public $total_discounts = 0;
    public $cnpaia_base = 0;
    public $cnpaia_amount = 0;
    public $taxable_amount = 0;
    public $tax_rate = 22;
    public $tax_amount = 0;
    public $total = 0;

    // Struttura semplificata: ogni elemento ha un group_id e un order_within_group
    public $items = [];
    public $nextItemId = 1;
    public $nextGroupId = 1;

    public function mount()
    {
        $this->loadLists();
        $this->setDefaultValues();
        $this->form->same_as_billing = true;

        // Inizializza il primo gruppo
        $this->nextGroupId = 1;
        $this->nextItemId = 1;
    }

    protected function loadLists()
    {
        $this->issuers = Issuer::orderBy('name')->get();
        $this->clients = Client::orderBy('name')->get();
        $this->price_lists = PriceList::orderBy('name')->get();
        $this->templates = QuoteTemplate::orderBy('name')->get();
        $this->users = User::orderBy('last_name')->take(10)->get();
        $this->products = Product::with('category')
            ->where('is_active', true)
            ->orderBy('title')
            ->get();
    }

    protected function setDefaultValues()
    {
        $this->form->due_date = now()->addDays(60)->format('Y-m-d');
        $this->form->payment_terms = '30 gg';
        $this->form->payment_method = 'Da definire';
        $this->form->billing_country = 'Italia';
        $this->form->delivery_country = 'Italia';
        $this->form->status = 'draft';
    }

    public function updatedFormClientId($clientId)
    {
        if ($clientId) {
            $client = Client::find($clientId);
            if ($client) {
                $this->form->billing_address = $client->address;
                $this->form->billing_city = $client->city;
                $this->form->billing_province = $client->province;
                $this->form->billing_country = $client->country;

                if ($this->form->same_as_billing) {
                    $this->updateDeliveryAddress();
                }
            }
        }
    }

    public function updatedFormSameAsBilling($value)
    {
        if ($value) {
            $this->updateDeliveryAddress();
        }
    }

    protected function updateDeliveryAddress()
    {
        $this->form->delivery_address = $this->form->billing_address;
        $this->form->delivery_city = $this->form->billing_city;
        $this->form->delivery_province = $this->form->billing_province;
        $this->form->delivery_country = $this->form->billing_country;
    }

    public function updatedFormQuoteTemplateId($templateId)
    {
        if ($templateId) {
            $template = QuoteTemplate::with('lines.product')->find($templateId);
            if ($template) {
                // Pulisci gli elementi esistenti
                $this->items = [];

                // Aggiungi elementi dal template al primo gruppo
                foreach ($template->lines as $line) {
                    if ($line->product_id) {
                        $product = $line->product;
                        $this->addProductToGroup(1, $product, $line->quantity ?? 1);
                    } else {
                        $this->addNoteToGroup(1, $line->description);
                    }
                }

                $this->calculateTotals();
            }
        }
    }

    /**
     * Aggiungi un titolo al primo gruppo
     */
    public function addTitle()
    {
        $this->addTitleToGroup(1);
    }

    /**
     * Aggiungi un servizio al primo gruppo
     */
    public function addProduct()
    {
        $this->addProductToGroup(1);
    }

    /**
     * Aggiungi una nota al primo gruppo
     */
    public function addNote()
    {
        $this->addNoteToGroup(1);
    }

    /**
     * Aggiungi un titolo a un gruppo specifico
     */
    protected function addTitleToGroup($groupId, $title = 'Nuovo Titolo')
    {
        // Assicurati che il gruppo esista
        $this->ensureGroupExists($groupId);

        $this->items[] = [
            'id' => $this->nextItemId++,
            'group_id' => $groupId,
            'type' => 'title',
            'title' => $title,
            'product_id' => null,
            'product_code' => '',
            'quantity' => 0,
            'uom' => '',
            'unit_price' => 0,
            'discount_pct' => 0,
            'line_total' => 0,
            'is_cnpaia' => false,
            'order_within_group' => $this->getNextOrderInGroup($groupId)
        ];

        $this->reorderItemsInGroups();
    }

    /**
     * Aggiungi un prodotto a un gruppo specifico
     */
    protected function addProductToGroup($groupId, $product = null, $quantity = 1)
    {
        // Assicurati che il gruppo esista
        $this->ensureGroupExists($groupId);

        $this->items[] = [
            'id' => $this->nextItemId++,
            'group_id' => $groupId,
            'type' => 'product',
            'title' => $product ? $product->title : '',
            'product_id' => $product ? $product->id : null,
            'product_code' => $product ? $product->unique_code : '',
            'quantity' => $quantity,
            'uom' => $product ? $product->uom : 'a corpo',
            'unit_price' => $product ? $product->price : 0,
            'discount_pct' => 0,
            'line_total' => $product ? ($product->price * $quantity) : 0,
            'is_cnpaia' => $product ? $product->is_cnpaia : true,
            'order_within_group' => $this->getNextOrderInGroup($groupId)
        ];

        $this->reorderItemsInGroups();
        $this->calculateTotals();
    }

    /**
     * Aggiungi una nota a un gruppo specifico
     */
    protected function addNoteToGroup($groupId, $note = '')
    {
        // Assicurati che il gruppo esista
        $this->ensureGroupExists($groupId);

        $this->items[] = [
            'id' => $this->nextItemId++,
            'group_id' => $groupId,
            'type' => 'note',
            'title' => $note,
            'product_id' => null,
            'product_code' => '',
            'quantity' => 0,
            'uom' => '',
            'unit_price' => 0,
            'discount_pct' => 0,
            'line_total' => 0,
            'is_cnpaia' => false,
            'order_within_group' => $this->getNextOrderInGroup($groupId)
        ];

        $this->reorderItemsInGroups();
    }

    /**
     * Assicura che un gruppo esista
     */
    protected function ensureGroupExists($groupId)
    {
        if ($groupId > $this->nextGroupId - 1) {
            $this->nextGroupId = $groupId + 1;
        }
    }

    /**
     * Ottieni il prossimo numero d'ordine in un gruppo
     */
    protected function getNextOrderInGroup($groupId)
    {
        $maxOrder = 0;
        foreach ($this->items as $item) {
            if ($item['group_id'] == $groupId) {
                $maxOrder = max($maxOrder, $item['order_within_group']);
            }
        }
        return $maxOrder + 1;
    }

    /**
     * Rimuovi un elemento
     */
    public function removeItem($itemId)
    {
        $this->items = array_filter($this->items, function($item) use ($itemId) {
            return $item['id'] != $itemId;
        });

        $this->items = array_values($this->items); // Re-index array
        $this->reorderItemsInGroups();
        $this->calculateTotals();
    }

    /**
     * Gestisce il riordinamento degli elementi tramite drag & drop
     * $orderedIds: array di ID nell'ordine finale voluto
     */
    public function updateItemsOrder($orderedIds)
    {
        // Crea una mappa temporanea degli elementi
        $itemsMap = [];
        foreach ($this->items as $item) {
            $itemsMap[$item['id']] = $item;
        }

        // Ricostruisci l'array nell'ordine specificato
        $reorderedItems = [];
        foreach ($orderedIds as $id) {
            if (isset($itemsMap[$id])) {
                $reorderedItems[] = $itemsMap[$id];
            }
        }

        $this->items = $reorderedItems;

        // Rigenera i gruppi basandosi sulla nuova posizione
        $this->regenerateGroups();
        $this->reorderItemsInGroups();
        $this->calculateTotals();
    }

    /**
     * Rigenera i gruppi basandosi sull'ordine degli elementi
     */
    protected function regenerateGroups()
    {
        $currentGroupId = 1;
        $this->nextGroupId = 1;

        foreach ($this->items as $index => $item) {
            if ($item['type'] === 'title') {
                // I titoli definiscono nuovi gruppi, eccetto se sono il primo elemento dopo un altro titolo
                if ($index === 0) {
                    // Primo elemento: inizia gruppo 1
                    $this->items[$index]['group_id'] = 1;
                    $currentGroupId = 1;
                } else {
                    // Controlla se l'elemento precedente era un titolo
                    $previousItem = $this->items[$index - 1];
                    if ($previousItem['type'] === 'title') {
                        // Due titoli consecutivi: mantieni lo stesso gruppo
                        $this->items[$index]['group_id'] = $currentGroupId;
                    } else {
                        // Inizia un nuovo gruppo
                        $currentGroupId++;
                        $this->items[$index]['group_id'] = $currentGroupId;
                    }
                }
            } else {
                // Servizi e note ereditano il gruppo dall'ultimo titolo visto
                $this->items[$index]['group_id'] = $currentGroupId;
            }
        }

        $this->nextGroupId = $currentGroupId + 1;
    }

    /**
     * Riordina gli elementi all'interno di ogni gruppo mantenendo l'ordine: titoli -> prodotti -> note
     */
    protected function reorderItemsInGroups()
    {
        // Raggruppa per group_id
        $groupedItems = [];
        foreach ($this->items as $item) {
            $groupId = $item['group_id'];
            if (!isset($groupedItems[$groupId])) {
                $groupedItems[$groupId] = ['titles' => [], 'products' => [], 'notes' => []];
            }

            switch ($item['type']) {
                case 'title':
                    $groupedItems[$groupId]['titles'][] = $item;
                    break;
                case 'product':
                    $groupedItems[$groupId]['products'][] = $item;
                    break;
                case 'note':
                    $groupedItems[$groupId]['notes'][] = $item;
                    break;
            }
        }

        // Ricostruisci l'array ordinato
        $orderedItems = [];
        ksort($groupedItems); // Ordina per group_id

        foreach ($groupedItems as $groupId => $group) {
            $orderInGroup = 1;

            // Prima i titoli
            foreach ($group['titles'] as $item) {
                $item['order_within_group'] = $orderInGroup++;
                $orderedItems[] = $item;
            }

            // Poi i prodotti
            foreach ($group['products'] as $item) {
                $item['order_within_group'] = $orderInGroup++;
                $orderedItems[] = $item;
            }

            // Infine le note
            foreach ($group['notes'] as $item) {
                $item['order_within_group'] = $orderInGroup++;
                $orderedItems[] = $item;
            }
        }

        $this->items = $orderedItems;
        $this->prepareFormData();
    }

    /**
     * Prepara i dati per il form
     */
    protected function prepareFormData()
    {
        $this->form->item_groups = [];

        // Raggruppa gli elementi per group_id
        $groupedItems = [];
        foreach ($this->items as $item) {
            $groupId = $item['group_id'];
            if (!isset($groupedItems[$groupId])) {
                $groupedItems[$groupId] = [
                    'title' => '',
                    'items' => []
                ];
            }

            if ($item['type'] === 'title') {
                $groupedItems[$groupId]['title'] = $item['title'];
            } elseif ($item['type'] === 'product' || $item['type'] === 'note') {
                $groupedItems[$groupId]['items'][] = [
                    'product_id' => $item['product_id'],
                    'product_code' => $item['product_code'],
                    'title' => $item['title'],
                    'quantity' => $item['quantity'],
                    'uom' => $item['uom'],
                    'unit_price' => $item['unit_price'],
                    'discount_pct' => $item['discount_pct'],
                    'line_total' => $item['line_total'],
                    'is_cnpaia' => $item['is_cnpaia'],
                    'type' => $item['type']
                ];
            }
        }

        // Ordina per group_id e assegna al form
        ksort($groupedItems);
        $this->form->item_groups = array_values($groupedItems);
    }

    /**
     * Seleziona un prodotto
     */
    public function selectProduct($itemId, $productId)
    {
        $product = Product::find($productId);
        if (!$product) return;

        foreach ($this->items as $index => $item) {
            if ($item['id'] == $itemId) {
                $this->items[$index]['product_id'] = $product->id;
                $this->items[$index]['product_code'] = $product->unique_code;
                $this->items[$index]['title'] = $product->title;
                $this->items[$index]['uom'] = $product->uom;
                $this->items[$index]['unit_price'] = $product->price;
                $this->items[$index]['is_cnpaia'] = $product->is_cnpaia;

                // Calcola il totale della riga
                $this->calculateItemTotal($itemId);
                break;
            }
        }

        $this->prepareFormData();
    }

    /**
     * Calcola il totale per un elemento
     */
    public function calculateItemTotal($itemId)
    {
        foreach ($this->items as $index => $item) {
            if ($item['id'] == $itemId) {
                $quantity = floatval($item['quantity'] ?? 1);
                $unitPrice = floatval($item['unit_price'] ?? 0);
                $discountPct = floatval($item['discount_pct'] ?? 0);

                $discountMultiplier = (100 - $discountPct) / 100;
                $lineTotal = $quantity * $unitPrice * $discountMultiplier;

                $this->items[$index]['line_total'] = $lineTotal;
                break;
            }
        }

        $this->prepareFormData();
        $this->calculateTotals();
    }

    /**
     * Calcola tutti i totali
     */
    public function calculateTotals()
    {
        $this->subtotal = 0;
        $this->total_discounts = 0;
        $this->cnpaia_base = 0;

        foreach ($this->items as $item) {
            if ($item['type'] === 'product') {
                $this->subtotal += floatval($item['line_total'] ?? 0);

                $quantity = floatval($item['quantity'] ?? 1);
                $unitPrice = floatval($item['unit_price'] ?? 0);
                $discountPct = floatval($item['discount_pct'] ?? 0);

                if ($discountPct > 0) {
                    $this->total_discounts += $quantity * $unitPrice * ($discountPct / 100);
                }

                if (isset($item['is_cnpaia']) && $item['is_cnpaia']) {
                    $this->cnpaia_base += floatval($item['line_total'] ?? 0);
                }
            }
        }

        // Calcolo CNPAIA (4%)
        $this->cnpaia_amount = $this->cnpaia_base * 0.04;

        // Imponibile
        $this->taxable_amount = $this->subtotal + $this->cnpaia_amount;

        // Calcolo IVA
        $this->tax_amount = $this->taxable_amount * ($this->tax_rate / 100);

        // Totale
        $this->total = $this->taxable_amount + $this->tax_amount;

        // Aggiorna il valore nel form
        $this->form->total = $this->total;
    }

    /**
     * Ottieni i gruppi organizzati per la visualizzazione
     */
    public function getGroupedItems()
    {
        $groups = [];

        foreach ($this->items as $item) {
            $groupId = $item['group_id'];

            if (!isset($groups[$groupId])) {
                $groups[$groupId] = [
                    'id' => $groupId,
                    'title' => '',
                    'items' => []
                ];
            }

            if ($item['type'] === 'title') {
                $groups[$groupId]['title'] = $item['title'];
                $groups[$groupId]['title_item'] = $item;
            }

            $groups[$groupId]['items'][] = $item;
        }

        ksort($groups);
        return $groups;
    }

    /**
     * Salva il preventivo
     */
    public function saveQuote()
    {
        // Aggiorna il totale nel form prima di salvare
        $this->form->total = $this->total;

        // Utilizza il metodo store del form
        $result = $this->form->store();

        if ($result instanceof \App\Models\Quote) {
            // Successo
            Flux::toast(
                text: "Preventivo " . $result->code . " creato con successo!",
                variant: 'success',
            );

            return redirect()->route('crm.quotes.show', $result);
        } else {
            // Errore
            Flux::toast(
                text: "Errore durante la creazione del preventivo: " . $result,
                variant: 'error',
            );
        }
    }


}