<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attach extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'path',
        'disk_path',
        'real_name',
        'saved_name',
        'size',
        'extension',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
