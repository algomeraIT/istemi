<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectStart extends Model
{
    use HasFactory;

    protected $table = 'project_start';

    protected $fillable = [
        'client_id',
        'project_id',
        'contract_ver',
        'user_contract_ver',
        'status_contract_ver',
        'cme_ver',
        'user_cme_ver',
        'status_cme_ver',
        'reserves',
        'user_reserves',
        'status_reserves',
        'expiring_date_project',
        'user_expiring_date_project',
        'status_expiring_date_project',
        'communication_plan',
        'extension',
        'user_extension',
        'status_extension',
        'sal',
        'user_sal',
        'status_sal',
        'warranty',
        'user_warranty',
        'status_warranty',
    ];

    // Relationships
    public function client()
    {
        return $this->belongsTo(Clients::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}