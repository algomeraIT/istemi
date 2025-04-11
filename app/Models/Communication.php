<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Communication extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'task',
        'assigned_to',
        'deadline',
        'to_do',
        'sender',
        'receiver',
        'attach_id',
        'has_multiple_attaches',
        'id_multiple_attaches',
        'notes',
        'user_id',
        'name_user',
        'last_name_user',
        'job_position_user',
        'status_user',
        'action',
        'note',
    ];

    public function attach()
    {
        return $this->belongsTo(Attach::class);
    }

    public function note()
    {
        return $this->belongsTo(Note::class);
    }

    public function user()
    {
        return $this->belongsTo(Users::class);
    }
    public function client()
    {
        return $this->belongsTo(Clients::class);
    }
}
