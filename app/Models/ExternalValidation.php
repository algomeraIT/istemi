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
        'name_phase',
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

    public static function createFromPhases(array $formData, array $selected, int $projectId): void
{
    $fields = ['external_validation', 'cre', 'liquidation', 'balance_invoice'];

    $labels = [
        'cre' => 'CRE',
        'liquidation' => 'Liquidazione',
        'balance_invoice' => 'Predisposizione della fattura al saldo',
    ];

    foreach ($fields as $phase) {
        if (in_array($phase, $selected)) {
            self::create([
                'client_id' => $formData['id_client'],
                'project_id' => $projectId,
                'user' => auth()->user()->name . ' ' . auth()->user()->last_name,
                'status' => 'In attesa',
                'name_phase' => $labels[$phase] ?? $phase,

                'external_validation' => in_array('external_validation', $selected),
                'user_external_validation' => $formData['user_external_validation'] ?? null,
                'status_external_validation' => false,

                'cre' => in_array('cre', $selected),
                'user_cre' => $formData['user_cre'] ?? null,
                'status_cre' => false,

                'liquidation' => in_array('liquidation', $selected),
                'user_liquidation' => $formData['user_liquidation'] ?? null,
                'status_liquidation' => false,

                'balance_invoice' => in_array('balance_invoice', $selected),
                'user_balance_invoice' => $formData['user_balance_invoice'] ?? null,
                'status_balance_invoice' => false,
            ]);
        }
    }
}
}