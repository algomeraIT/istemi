<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'project_id',

        'report',
        'user_report',
        'status_report',

        'create_note',
        'user_create_note',
        'status_create_note',

        'sending_note',
        'user_sending_note',
        'status_sending_note',
    ];

    // Relationships

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function reportUser()
    {
        return $this->belongsTo(User::class, 'user_report');
    }

    public function createNoteUser()
    {
        return $this->belongsTo(User::class, 'user_create_note');
    }

    public function sendingNoteUser()
    {
        return $this->belongsTo(User::class, 'user_sending_note');
    }
}