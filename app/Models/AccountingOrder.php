<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountingOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'order_number',
        'date',
        'country',
        'shipper',
        'total_price',
        'status',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
