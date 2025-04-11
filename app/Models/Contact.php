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
}
