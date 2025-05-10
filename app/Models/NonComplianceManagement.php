<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonComplianceManagement extends Model
{
    use HasFactory;

    protected $table = 'non_compliance_management';

    protected $fillable = [
        'client_id',
        'project_id',
        'non_compliance_management',
        'user_non_compliance_management',
        'status_non_compliance_management',
        'sa',
        'user_sa',
        'status_sa',
        'integrate_doc',
        'user_integrate_doc',
        'status_integrate_doc',
    ];

    public function client()
    {return $this->belongsTo(Client::class);}
    public function project()
    {return $this->belongsTo(Project::class);}
    public function userNonComplianceManagement()
    {return $this->belongsTo(User::class, 'user_non_compliance_management');}
    public function userSa()
    {return $this->belongsTo(User::class, 'user_sa');}
    public function userIntegrateDoc()
    {return $this->belongsTo(User::class, 'user_integrate_doc');}
}
