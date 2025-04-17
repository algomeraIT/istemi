<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estimate extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'user_id',
        'referent_id',
        'address_invoice',
        'city',
        'cap',
        'country',
        'has_same_address_for_delivery',
        'price_list',
        'expiration',
        'term_pay',
        'method_pay',
        'title_service',
        'service',
        'note_service',
        'serial_number',
        'serial_number',
        'date_expiration',
        'status_expiration',
        'price',
        'total',
        'status',
    ];
}
