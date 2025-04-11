<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_leads',
        'is_email',
        'is_leads',
        'is_email',
        'body',
        'status'
    ];

    protected $casts = [
        'is_leads' => 'boolean',
        'is_email' => 'boolean',
        'status' => 'integer',
    ];
}