<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuoteTemplate extends Model
{
    /**
     * @return HasMany
     */
    public function lines(): HasMany
    {
        return $this->hasMany(QuoteTemplateLine::class)->orderBy('sort_order');
    }

    /**
     * @return BelongsTo
     */
    public function issuer(): BelongsTo
    {
        return $this->belongsTo(Issuer::class);
    }

    /**
     * @return BelongsTo
     */
    public function priceList(): BelongsTo
    {
        return $this->belongsTo(PriceList::class);
    }
}
