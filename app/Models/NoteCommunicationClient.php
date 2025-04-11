<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoteCommunicationClient extends Model
{
    use HasFactory;

    protected $table = 'note_communication_client';

    protected $fillable = [
        'client_id',
        'user_id',
        'name_user',
        'last_name_user',
        'role_user',
        'attach_id',
        'id_note',
    ];

    public function client()
    {
        return $this->belongsTo(Clients::class);
    }

    public function user()
    {
        return $this->belongsTo(Users::class);
    }

    public function note()
    {
        return $this->belongsTo(Note::class, 'id_note');
    }
}