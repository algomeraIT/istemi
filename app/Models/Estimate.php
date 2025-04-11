<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estimate extends Model
{
    use HasFactory;

    protected $fillable = [
        'serial_number',
        'date_expiration',
        'status_expiration',
        'price',
        'total',
        'status',
    ];
}
