<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'email',
        'pec',
        'registered_office_address',
        'first_telephone',
        'second_telephone',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(Users::class, 'user_id_creation');
    }

    public function referents()
    {
        return $this->hasMany(Referent::class, 'client_id');
    }
    public function communication()
    {
        return $this->hasMany(Communication::class, 'client_id');
    }
}
