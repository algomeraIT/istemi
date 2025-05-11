<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExternalValidation extends Model
{
    use HasFactory;

    protected $table = 'external_validations';

    protected $fillable = [
        'client_id',
        'project_id',
        'user',
        'status',
        'external_validation',
        'user_external_validation',
        'status_external_validation',
        'cre',
        'user_cre',
        'status_cre',
        'liquidation',
        'user_liquidation',
        'status_liquidation',
        'balance_invoice',
        'user_balance_invoice',
        'status_balance_invoice',
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