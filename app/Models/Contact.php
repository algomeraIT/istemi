<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'user_id',
        'estimate_id',
        'name',
        'email',
        'pec',
        'registered_office_address',
        'first_telephone',
        'second_telephone',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function referents()
    {
        return $this->hasMany(Referent::class, 'client_id');
    }
    public function estimate()
    {
        return $this->hasMany(Estimate::class, 'estimate_id');
    }
}
