<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'last_phase',
        'note_project',
        'estimate_project',
        'id_client',
        'name_client',
        'logo_path_client',
        'note_client',
        'address_client',
        'status',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
