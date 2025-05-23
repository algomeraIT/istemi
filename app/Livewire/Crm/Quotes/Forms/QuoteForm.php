<?php

namespace App\Livewire\Crm\Quotes\Forms;

use App\Models\Quote;
use App\Models\QuoteItemGroup;
use App\Models\QuoteItem;
use Illuminate\Support\Facades\DB;
use Livewire\Form;
use Livewire\Attributes\Validate;

class QuoteForm extends Form
{
    /**
     * @var Quote|null
     */
    public ?Quote $quote = null;

    // Basic quote information
    #[Validate('required|exists:issuers,id')]
    public ?int $issuer_id = null;

    #[Validate('required|exists:clients,id')]
    public ?int $client_id = null;

    #[Validate('nullable|string')]
    public ?string $code = null;

    #[Validate('required|string')]
    public string $status = 'draft';

    #[Validate('required|date')]
    public ?string $due_date = null;

    #[Validate('required|numeric|min:0')]
    public float $total = 0.0;

    // Addresses
    #[Validate('required|string')]
    public string $billing_country = 'Italia';

    #[Validate('required|string')]
    public string $billing_city = '';

    #[Validate('required|string')]
    public string $billing_province = '';

    #[Validate('required|string')]
    public string $billing_address = '';

    #[Validate('nullable|string')]
    public ?string $billing_cap = null;

    #[Validate('required|string')]
    public string $delivery_country = 'Italia';

    #[Validate('required|string')]
    public string $delivery_city = '';

    #[Validate('required|string')]
    public string $delivery_province = '';

    #[Validate('required|string')]
    public string $delivery_address = '';

    #[Validate('nullable|string')]
    public ?string $delivery_cap = null;

    // Quote details
    #[Validate('required|string')]
    public string $subject = '';

    #[Validate('nullable|exists:price_lists,id')]
    public ?int $price_list_id = null;

    #[Validate('nullable|exists:quote_templates,id')]
    public ?int $quote_template_id = null;

    #[Validate('nullable|json')]
    public ?string $terms = null;

    #[Validate('nullable|exists:tax_rates,id')]
    public ?int $tax_rate_id = null;

    // Fields not directly on the model
    public bool $same_as_billing = false;
    public array $area_managers = [];
    public array $tech_users = [];
    public array $item_groups = [];
    public string $payment_terms = '30 gg';
    public string $payment_method = 'Da definire';

    /**
     * Set quote data from model
     */
    public function setQuote(Quote $quote): void
    {
        $this->quote = $quote;

        // Set all properties from the quote object
        foreach (array_keys($this->except('quote', 'same_as_billing', 'area_managers', 'tech_users', 'item_groups', 'payment_terms', 'payment_method')) as $field) {
            $this->{$field} = $quote->{$field};
        }

        // Load relationships
        $this->area_managers = $quote->areaUsers()->pluck('user_id')->toArray();
        $this->tech_users = $quote->techUsers()->pluck('user_id')->toArray();

        // Load item groups with items
        $this->item_groups = [];
        foreach ($quote->itemGroups()->orderBy('sort_order')->get() as $group) {
            $items = [];

            foreach ($group->items as $item) {
                $items[] = [
                    'product_id' => $item->product_id,
                    'product_code' => $item->product->unique_code ?? '',
                    'title' => $item->title ?? ($item->product->title ?? ''),
                    'quantity' => $item->quantity,
                    'uom' => $item->uom,
                    'unit_price' => $item->unit_price,
                    'discount_pct' => $item->discount_pct,
                    'line_total' => $item->line_total,
                    'is_cnpaia' => $item->is_cnpaia,
                    'type' => $item->type
                ];
            }

            $this->item_groups[] = [
                'title' => $group->title,
                'items' => $items
            ];
        }
    }

    /**
     * Store a new quote with all its relationships
     *
     * @return Quote|string Quote instance on success, error message on failure
     */
    public function store()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            // 1. Create the main quote
            $quoteData = $this->only([
                'issuer_id', 'client_id', 'status', 'due_date', 'total',
                'billing_country', 'billing_city', 'billing_province', 'billing_address',
                'delivery_country', 'delivery_city', 'delivery_province', 'delivery_address',
                'subject', 'price_list_id', 'quote_template_id', 'terms', 'tax_rate_id'
            ]);

            // Generate a unique code if not already set
            if (empty($quoteData['code'])) {
                $quoteData['code'] = 'PRV' . now()->format('Ymd') . str_pad(Quote::count() + 1, 4, '0', STR_PAD_LEFT);
            }

            $quote = Quote::create($quoteData);

            // 2. Create area user relationships (pivot)
            if (!empty($this->area_managers)) {
                $quote->areaUsers()->attach($this->area_managers);
            }

            // 3. Create tech user relationships (pivot)
            if (!empty($this->tech_users)) {
                $quote->techUsers()->attach($this->tech_users);
            }

            // 4. Create quote item groups and items
            foreach ($this->item_groups as $index => $group) {
                // Skip empty groups (no title and no items)
                if (empty($group['title']) && empty($group['items'])) {
                    continue;
                }

                // Create the group
                $quoteGroup = new QuoteItemGroup();
                $quoteGroup->quote_id = $quote->id;
                $quoteGroup->title = $group['title'] ?? null;
                $quoteGroup->sort_order = $index;
                $quoteGroup->save();

                // Create the items in this group
                foreach ($group['items'] as $item) {
                    $quoteItem = new QuoteItem();
                    $quoteItem->quote_item_group_id = $quoteGroup->id;
                    $quoteItem->product_id = $item['product_id'] ?? null;
                    $quoteItem->type = $item['type'] ?? 'product';
                    $quoteItem->quantity = $item['quantity'] ?? 1;
                    $quoteItem->uom = $item['uom'] ?? 'a corpo';
                    $quoteItem->unit_price = $item['unit_price'] ?? 0;
                    $quoteItem->discount_pct = $item['discount_pct'] ?? 0;
                    $quoteItem->line_total = $item['line_total'] ?? 0;
                    $quoteItem->is_cnpaia = $item['is_cnpaia'] ?? false;
                    $quoteItem->save();
                }
            }

            DB::commit();

            return $quote;

        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }

    /**
     * Update an existing quote with all its relationships
     *
     * @return bool Success status
     */
    public function update(): bool
    {
        $this->validate();

        try {
            DB::beginTransaction();

            // 1. Update the main quote
            $quoteData = $this->only([
                'issuer_id', 'client_id', 'status', 'due_date', 'total',
                'billing_country', 'billing_city', 'billing_province', 'billing_address',
                'delivery_country', 'delivery_city', 'delivery_province', 'delivery_address',
                'subject', 'price_list_id', 'quote_template_id', 'terms', 'tax_rate_id'
            ]);

            $this->quote->update($quoteData);

            // 2. Update area user relationships (sync pivot)
            $this->quote->areaUsers()->sync($this->area_managers);

            // 3. Update tech user relationships (sync pivot)
            $this->quote->techUsers()->sync($this->tech_users);

            // 4. Update quote item groups and items
            // First, get existing groups to be able to delete any that are removed
            $existingGroups = $this->quote->itemGroups()->pluck('id')->toArray();
            $updatedGroups = [];

            foreach ($this->item_groups as $index => $group) {
                // Skip empty groups (no title and no items)
                if (empty($group['title']) && empty($group['items'])) {
                    continue;
                }

                // If group already exists (has ID), update it
                if (isset($group['id'])) {
                    $quoteGroup = QuoteItemGroup::find($group['id']);
                    $quoteGroup->title = $group['title'] ?? null;
                    $quoteGroup->sort_order = $index;
                    $quoteGroup->save();

                    $updatedGroups[] = $quoteGroup->id;

                    // Get existing items to be able to delete any that are removed
                    $existingItems = $quoteGroup->items()->pluck('id')->toArray();
                    $updatedItems = [];

                    foreach ($group['items'] as $item) {
                        // If item already exists (has ID), update it
                        if (isset($item['id'])) {
                            $quoteItem = QuoteItem::find($item['id']);
                            $quoteItem->product_id = $item['product_id'] ?? null;
                            $quoteItem->type = $item['type'] ?? 'product';
                            $quoteItem->quantity = $item['quantity'] ?? 1;
                            $quoteItem->uom = $item['uom'] ?? 'a corpo';
                            $quoteItem->unit_price = $item['unit_price'] ?? 0;
                            $quoteItem->discount_pct = $item['discount_pct'] ?? 0;
                            $quoteItem->line_total = $item['line_total'] ?? 0;
                            $quoteItem->is_cnpaia = $item['is_cnpaia'] ?? false;
                            $quoteItem->save();

                            $updatedItems[] = $quoteItem->id;
                        } else {
                            // Create new item
                            $quoteItem = new QuoteItem();
                            $quoteItem->quote_item_group_id = $quoteGroup->id;
                            $quoteItem->product_id = $item['product_id'] ?? null;
                            $quoteItem->type = $item['type'] ?? 'product';
                            $quoteItem->quantity = $item['quantity'] ?? 1;
                            $quoteItem->uom = $item['uom'] ?? 'a corpo';
                            $quoteItem->unit_price = $item['unit_price'] ?? 0;
                            $quoteItem->discount_pct = $item['discount_pct'] ?? 0;
                            $quoteItem->line_total = $item['line_total'] ?? 0;
                            $quoteItem->is_cnpaia = $item['is_cnpaia'] ?? false;
                            $quoteItem->save();

                            $updatedItems[] = $quoteItem->id;
                        }
                    }

                    // Delete items that were removed
                    QuoteItem::whereIn('id', array_diff($existingItems, $updatedItems))
                        ->where('quote_item_group_id', $quoteGroup->id)
                        ->delete();
                } else {
                    // Create new group
                    $quoteGroup = new QuoteItemGroup();
                    $quoteGroup->quote_id = $this->quote->id;
                    $quoteGroup->title = $group['title'] ?? null;
                    $quoteGroup->sort_order = $index;
                    $quoteGroup->save();

                    $updatedGroups[] = $quoteGroup->id;

                    // Create all items in this new group
                    foreach ($group['items'] as $item) {
                        $quoteItem = new QuoteItem();
                        $quoteItem->quote_item_group_id = $quoteGroup->id;
                        $quoteItem->product_id = $item['product_id'] ?? null;
                        $quoteItem->type = $item['type'] ?? 'product';
                        $quoteItem->quantity = $item['quantity'] ?? 1;
                        $quoteItem->uom = $item['uom'] ?? 'a corpo';
                        $quoteItem->unit_price = $item['unit_price'] ?? 0;
                        $quoteItem->discount_pct = $item['discount_pct'] ?? 0;
                        $quoteItem->line_total = $item['line_total'] ?? 0;
                        $quoteItem->is_cnpaia = $item['is_cnpaia'] ?? false;
                        $quoteItem->save();
                    }
                }
            }

            // Delete groups that were removed
            QuoteItemGroup::whereIn('id', array_diff($existingGroups, $updatedGroups))
                ->where('quote_id', $this->quote->id)
                ->delete();

            DB::commit();

            return true;

        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}