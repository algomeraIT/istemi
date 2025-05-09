<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoteCommunicationClientHistory extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = "note_communication_client_histories";
    protected $fillable = [
        'client_id',
        'user_id',
        'name_user',
        'last_name_user',
        'role_user',
        'attach_id',
        'note',
        'path'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function note()
    {
        return $this->belongsTo(Note::class, 'id_note');
    }
}