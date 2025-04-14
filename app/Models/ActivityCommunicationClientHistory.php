<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityCommunicationClientHistory extends Model
{
    use HasFactory;

    protected $table = 'activities_communication_client_history';

    protected $fillable = [
        'client_id',
        'name',
        'last_name',
        'role',
        'label',
        'to_do',
        'activities',
        'assignee',
        'id_assignee',
        'id_knowledge',
        'id_answer',
        'expire_at',
    ];

    public function client()
    {
        return $this->belongsTo(Clients::class);
    }

    public function assignee()
    {
        return $this->belongsTo(Users::class, 'id_assignee');
    }

    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }
}
