<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;

    protected $table = 'data';

    protected $fillable = [
        'client_id',
        'project_id',

        'data',
        'user_data',
        'status_data',

        'foreman_docs',
        'user_foreman_docs',
        'status_foreman_docs',

        'sanding_sample_lab',
        'user_sanding_sample_lab',
        'status_sanding_sample_lab',

        'data_validation',
        'user_data_validation',
        'status_data_validation',

        'internal_validation',
        'user_internal_validation',
        'status_internal_validation',
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

    public function userData()
    {
        return $this->belongsTo(User::class, 'user_data');
    }

    public function userForemanDocs()
    {
        return $this->belongsTo(User::class, 'user_foreman_docs');
    }

    public function userSandingSampleLab()
    {
        return $this->belongsTo(User::class, 'user_sanding_sample_lab');
    }

    public function userDataValidation()
    {
        return $this->belongsTo(User::class, 'user_data_validation');
    }

    public function userInternalValidation()
    {
        return $this->belongsTo(User::class, 'user_internal_validation');
    }
}