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

    public function mount()
    {
        // Load dropdown data
        $this->loadLists();

        // Set default values
        $this->setDefaultValues();

        $this->form->same_as_billing = true;
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

        // Initialize with an empty group
        $this->form->item_groups = [
            [
                'title' => '',
                'items' => []
            ]
        ];
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
                // If we already have groups, use the first one
                // or create a new one if none exist
                if (empty($this->form->item_groups)) {
                    $this->form->item_groups[] = [
                        'title' => '',
                        'items' => []
                    ];
                }

                $groupIndex = 0;

                // Add products from template
                foreach ($template->lines as $line) {
                    if ($line->product_id) {
                        $product = $line->product;

                        $this->form->item_groups[$groupIndex]['items'][] = [
                            'product_id' => $product->id,
                            'product_code' => $product->unique_code,
                            'title' => $product->title,
                            'quantity' => $line->quantity ?? 1,
                            'uom' => $product->uom,
                            'unit_price' => $product->price,
                            'discount_pct' => 0,
                            'line_total' => $product->price * ($line->quantity ?? 1),
                            'is_cnpaia' => $product->is_cnpaia,
                            'type' => 'product'
                        ];
                    } else {
                        // If it's a text/note
                        $this->form->item_groups[$groupIndex]['items'][] = [
                            'product_id' => null,
                            'product_code' => '',
                            'title' => $line->description,
                            'quantity' => $line->quantity ?? 1,
                            'uom' => $line->uom ?? 'a corpo',
                            'unit_price' => 0,
                            'discount_pct' => 0,
                            'line_total' => 0,
                            'is_cnpaia' => false,
                            'type' => 'note'
                        ];
                    }
                }

                $this->calculateTotals();
            }
        }
    }

    /**
     * Add a new title (creates a new group)
     */
    public function addTitle()
    {
        // Create a new group with a title
        $this->form->item_groups[] = [
            'title' => 'Nuovo Titolo',
            'items' => []
        ];
    }

    /**
     * Add a product to the current group (last group)
     */
    public function addProduct()
    {
        // If no groups exist, create one
        if (empty($this->form->item_groups)) {
            $this->form->item_groups[] = [
                'title' => '',
                'items' => []
            ];
        }

        // Get the last group index
        $lastGroupIndex = count($this->form->item_groups) - 1;

        // Add a product to the last group
        $this->form->item_groups[$lastGroupIndex]['items'][] = [
            'product_id' => null,
            'product_code' => '',
            'title' => '',
            'quantity' => 1,
            'uom' => 'a corpo',
            'unit_price' => 0,
            'discount_pct' => 0,
            'line_total' => 0,
            'is_cnpaia' => true,
            'type' => 'product'
        ];

        $this->calculateTotals();
    }

    /**
     * Add a note to the current group (last group)
     */
    public function addNote()
    {
        // If no groups exist, create one
        if (empty($this->form->item_groups)) {
            $this->form->item_groups[] = [
                'title' => '',
                'items' => []
            ];
        }

        // Get the last group index
        $lastGroupIndex = count($this->form->item_groups) - 1;

        // Add a note to the last group
        $this->form->item_groups[$lastGroupIndex]['items'][] = [
            'product_id' => null,
            'product_code' => '',
            'title' => '',
            'quantity' => 1,
            'uom' => 'a corpo',
            'unit_price' => 0,
            'discount_pct' => 0,
            'line_total' => 0,
            'is_cnpaia' => false,
            'type' => 'note'
        ];
    }

    /**
     * Remove an item from a group
     */
    public function removeItem($groupIndex, $itemIndex)
    {
        unset($this->form->item_groups[$groupIndex]['items'][$itemIndex]);
        $this->form->item_groups[$groupIndex]['items'] = array_values($this->form->item_groups[$groupIndex]['items']);
        $this->calculateTotals();
    }

    /**
     * Handle product selection
     */
    public function selectProduct($groupIndex, $itemIndex, $productId)
    {
        $product = Product::find($productId);
        if ($product) {
            $this->form->item_groups[$groupIndex]['items'][$itemIndex]['product_id'] = $product->id;
            $this->form->item_groups[$groupIndex]['items'][$itemIndex]['product_code'] = $product->unique_code;
            $this->form->item_groups[$groupIndex]['items'][$itemIndex]['title'] = $product->title;
            $this->form->item_groups[$groupIndex]['items'][$itemIndex]['uom'] = $product->uom;
            $this->form->item_groups[$groupIndex]['items'][$itemIndex]['unit_price'] = $product->price;
            $this->form->item_groups[$groupIndex]['items'][$itemIndex]['is_cnpaia'] = $product->is_cnpaia;

            $this->calculateItemTotal($groupIndex, $itemIndex);
        }
    }

    /**
     * Calculate the total for a specific item
     */
    public function calculateItemTotal($groupIndex, $itemIndex)
    {
        $item = $this->form->item_groups[$groupIndex]['items'][$itemIndex];
        $quantity = floatval($item['quantity'] ?? 1);
        $unitPrice = floatval($item['unit_price'] ?? 0);
        $discountPct = floatval($item['discount_pct'] ?? 0);

        $discountMultiplier = (100 - $discountPct) / 100;
        $lineTotal = $quantity * $unitPrice * $discountMultiplier;

        $this->form->item_groups[$groupIndex]['items'][$itemIndex]['line_total'] = $lineTotal;

        $this->calculateTotals();
    }

    /**
     * Calculate all totals
     */
    public function calculateTotals()
    {
        $this->subtotal = 0;
        $this->total_discounts = 0;
        $this->cnpaia_base = 0;

        foreach ($this->form->item_groups as $group) {
            foreach ($group['items'] as $item) {
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

        // CNPAIA calculation (4%)
        $this->cnpaia_amount = $this->cnpaia_base * 0.04;

        // Taxable amount
        $this->taxable_amount = $this->subtotal + $this->cnpaia_amount;

        // VAT calculation
        $this->tax_amount = $this->taxable_amount * ($this->tax_rate / 100);

        // Total
        $this->total = $this->taxable_amount + $this->tax_amount;

        // Update form value
        $this->form->total = $this->total;
    }

    /**
     * Save the quote
     */
    public function saveQuote()
    {
        // Update total in form before saving
        $this->form->total = $this->total;

        // Use form's store method
        $result = $this->form->store();

        if ($result instanceof \App\Models\Quote) {
            // Success
            Flux::toast(
                text: "Preventivo " . $result->code . " creato con successo!",
                variant: 'success',
            );

            return redirect()->route('crm.quotes.show', $result);
        } else {
            // Error
            Flux::toast(
                text: "Errore durante la creazione del preventivo: " . $result,
                variant: 'error',
            );
        }
    }

    public function render()
    {
        return view('livewire.crm.quotes.create');
    }
}