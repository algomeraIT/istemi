<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuoteTemplateLine extends Model
{
    /**
     * @var string[]
     */
    protected $casts = [
        'quantity'=>'float'
    ];

    /**
     * @return BelongsTo
     */
    public function template(): BelongsTo
    {
        return $this->belongsTo(QuoteTemplate::class);
    }

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
