<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailCommunicationClientHistory extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'email_communication_client_history';

    protected $fillable = [
        'client_id',
        'task',
        'assigned_to',
        'sender',
        'receiver',
        'attach_id',
        'has_multiple_attaches',
        'id_multiple_attaches',
        'user_id',
        'name_user',
        'last_name_user',
        'job_position_user',
        'status_user',
        'action',
        'note',
        'path',
    ];

    // Relationships
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function attach()
    {
        return $this->belongsTo(Attach::class, 'attach_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
