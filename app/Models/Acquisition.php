<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acquisition extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'invoice',
        'total_price',
        'status',
        'date',
    ];

    public function client()
    {
        return $this->belongsTo(Clients::class);
    }
}
