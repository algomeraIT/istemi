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
        'name_phase',
        'user',
        'status',
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

    public static function createFromPhases(array $formData, array $selected, int $projectId): void
    {
        $fields = ['non_compliance_management', 'sa', 'integrate_doc'];

        $labels = [
            'sa' => 'Accogliere le richieste/integrazioni della S.A.',
            'integrate_doc' => 'Produrre ed inviare documentazione integrativa',
        ];

        foreach ($fields as $phase) {
            if (in_array($phase, $selected)) {
                self::create([
                    'client_id' => $formData['id_client'],
                    'project_id' => $projectId,
                    'user' => auth()->user()->name . ' ' . auth()->user()->last_name,
                    'status' => 'In attesa',
                    'name_phase' => $labels[$phase] ?? $phase,

                    'non_compliance_management' => in_array('non_compliance_management', $selected),
                    'user_non_compliance_management' => $formData['user_non_compliance_management'] ?? null,
                    'status_non_compliance_management' => false,

                    'sa' => in_array('sa', $selected),
                    'user_sa' => $formData['user_sa'] ?? null,
                    'status_sa' => false,

                    'integrate_doc' => in_array('integrate_doc', $selected),
                    'user_integrate_doc' => $formData['user_integrate_doc'] ?? null,
                    'status_integrate_doc' => false,
                ]);
            }
        }
    }
}
