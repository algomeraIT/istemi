<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoteProject extends Model {
    use HasFactory;

    protected $table = 'notes_projects';

    protected $fillable = [
        'project_id',
        'client_id',
        'note',
        'user_name',
        'user_id',
        'role'
    ];

    public function project() {
        return $this->belongsTo(Project::class);
    }

    public function client() {
        return $this->belongsTo(Client::class);
    }
}