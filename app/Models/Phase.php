<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phase extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_area',
        'id_micro_area',
        'id_project',
        'id_user',
        'status',
    ];

    public function area()
    {
        return $this->belongsTo(Area::class, 'id_area');
    }

    public function microArea()
    {
        return $this->belongsTo(MicroArea::class, 'id_micro_area');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}