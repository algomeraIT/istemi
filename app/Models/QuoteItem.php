<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuoteItem extends Model
{

    protected $casts = [
        'quantity' => 'decimal:2',
        'unit_price' => 'decimal:2',
        'discount_pct' => 'integer',
        'line_total' => 'decimal:2',
        'is_cnpaia' => 'boolean'
    ];

    public function group()
    {
        return $this->belongsTo(QuoteItemGroup::class, 'quote_item_group_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Calculate line total before saving
    protected static function booted()
    {
        static::saving(function ($item) {
            $discountMultiplier = (100 - $item->discount_pct) / 100;
            $item->line_total = $item->quantity * $item->unit_price * $discountMultiplier;
        });
    }

}
