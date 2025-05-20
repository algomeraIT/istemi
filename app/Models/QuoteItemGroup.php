<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuoteItemGroup extends Model
{
    public function quote()
    {
        return $this->belongsTo(Quote::class);
    }

    public function items()
    {
        return $this->hasMany(QuoteItem::class);
    }

    public function getSubtotalAttribute()
    {
        return $this->items->sum('line_total');
    }

}
