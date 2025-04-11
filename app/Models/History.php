<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name_user',
        'last_name_user',
        'job_position_user',
        'role_user',
        'status_user',
        'action',
        'id_notes',
    ];

    public function user()
    {
        return $this->belongsTo(Users::class);
    }

    public function note()
    {
        return $this->belongsTo(Note::class, 'id_notes');
    }
}
