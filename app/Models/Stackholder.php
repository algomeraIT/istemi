<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stackholder extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'last_name',
        'role',
        'email',
        'project_id',
    ];

}
