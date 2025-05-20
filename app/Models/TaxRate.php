<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaxRate extends Model
{
    protected $casts = [
        'rate' => 'decimal:2',
        'active' => 'boolean'
    ];

    // Scope for active tax rates
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
}
