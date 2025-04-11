<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'email',
        'pec',
        'service',
        'provenance',
        'registered_office_address',
        'first_telephone',
        'second_telephone',
        'note',
        'sales_manager',
        'status',
        'acquisition_date',
    ];
}