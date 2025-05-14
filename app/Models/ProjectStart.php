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
        'name_phase',
        'user',
        'status',
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
        return $this->belongsTo(Client::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public static function createFromPhases(array $formData, array $selected, int $projectId): void
    {
        $phases = [
            'contract_ver',
            'cme_ver',
            'reserves',
            'expiring_date_project',
            'communication_plan',
            'extension',
            'sal',
            'warranty',
        ];

        $labels = [
            'contract_ver' => 'Verifica contratto',
            'cme_ver' => 'Verifica CME',
            'reserves' => 'Riserve',
            'expiring_date_project' => 'Impostare data di scadenza progetto',
            'communication_plan' => 'Definizione del piano di comunicazione',
            'extension' => 'Proroga',
            'sal' => 'Possibilità di produrre dei SAL',
            'warranty' => 'Garanzia definitiva',
        ];

        foreach ($phases as $phase) {
            if (in_array($phase, $selected)) {
                self::create([
                    'client_id' => $formData['id_client'],
                    'project_id' => $projectId,
                    'user' => auth()->user()->name . ' ' . auth()->user()->last_name,
                    'status' => 'In attesa',
                    'name_phase' => $labels[$phase] ?? $phase,

                    'contract_ver' => in_array('contract_ver', $selected),
                    'user_contract_ver' => $formData['user_contract_ver'] ?? null,
                    'status_contract_ver' => false,

                    'cme_ver' => in_array('cme_ver', $selected),
                    'user_cme_ver' => $formData['user_cme_ver'] ?? null,
                    'status_cme_ver' => false,

                    'reserves' => in_array('reserves', $selected),
                    'user_reserves' => $formData['user_reserves'] ?? null,
                    'status_reserves' => false,

                    'expiring_date_project' => in_array('expiring_date_project', $selected),
                    'user_expiring_date_project' => $formData['user_expiring_date_project'] ?? null,
                    'status_expiring_date_project' => false,

                    'communication_plan' => in_array('communication_plan', $selected),

                    'extension' => in_array('extension', $selected),
                    'user_extension' => $formData['user_extension'] ?? null,
                    'status_extension' => false,

                    'sal' => in_array('sal', $selected),
                    'user_sal' => $formData['user_sal'] ?? null,
                    'status_sal' => false,

                    'warranty' => in_array('warranty', $selected),
                    'user_warranty' => $formData['user_warranty'] ?? null,
                    'status_warranty' => false,
                ]);
            }
        }
    }
}
