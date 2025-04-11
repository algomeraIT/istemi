<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountingInvoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'number_invoice',
        'date_invoice',
        'expire_invoice',
        'taxable',
        'total',
        'status',
    ];

    public function client()
    {
        return $this->belongsTo(Clients::class);
    }
}