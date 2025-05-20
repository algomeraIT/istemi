<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use RichanFongdasen\EloquentBlameable\BlameableTrait;

class Quote extends Model
{
    use BlameableTrait;

    protected $casts = [
        'terms' => 'array',
        'due_date' => 'date',
        'total' => 'decimal:2'
    ];

    public function itemGroups()
    {
        return $this->hasMany(QuoteItemGroup::class)->orderBy('sort_order');
    }

    // Relationships
    public function issuer()
    {
        return $this->belongsTo(Issuer::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function items()
    {
        return $this->hasManyThrough(QuoteItem::class, QuoteItemGroup::class);
    }

    public function techUsers()
    {
        return $this->belongsToMany(User::class, 'quote_tech_users');
    }

    public function areaUsers()
    {
        return $this->belongsToMany(User::class, 'quote_area_users');
    }

    public function priceList()
    {
        return $this->belongsTo(PriceList::class);
    }

    public function taxRate()
    {
        return $this->belongsTo(TaxRate::class);
    }

    public function template()
    {
        return $this->belongsTo(QuoteTemplate::class, 'quote_template_id');
    }

    // Calculated attributes
    public function getSubtotalAttribute()
    {
        // Calculate subtotal from items
    }

    public function getTaxAmountAttribute()
    {
        // Calculate tax amount
    }

    public function getCnpaiaBaseAttribute()
    {
        // Sum of all items where is_cnpaia = true
        return $this->itemGroups()
            ->with('items')
            ->get()
            ->flatMap(function($group) {
                return $group->items;
            })
            ->where('is_cnpaia', true)
            ->sum('line_total');
    }

    public function getCnpaiaAmountAttribute()
    {
        // Calculate 4% of the CNPAIA base
        return $this->cnpaia_base * 0.04;
    }
}
