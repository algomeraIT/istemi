<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'client_id',
        'user_id',
        'user_name',
        'project_start_id',
        'project_activity_id',
        'project_accounting_id',
        'project_data_id',
        'project_construction_site_plane_id',
        'project_external_validations_id',
        'project_invoices_sal_id',
        'project_non_compliance_id',
        'project_report_id',
        'project_close_id',
        'title',
        'assignee',
        'cc',
        'expire',
        'note',
        'media',
        'status',

    ];

    protected $casts = [
        'media' => 'array',
        'expire' => 'date',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
