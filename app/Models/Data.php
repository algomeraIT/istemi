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
        'name_phase',
        'user',
        'status',
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

    public static function createFromPhases(array $formData, array $selected, int $projectId): void
    {
        $fields = ['data', 'foreman_docs', 'sanding_sample_lab', 'data_validation', 'internal_validation'];

        $labels = [
            'foreman_docs' => 'Controllo documentazione fornita dal caposquadra',
            'sanding_sample_lab' => 'Spedizione campioni ai laboratori',
            'data_validation' => 'Avvio attività di analisi dati',
            'internal_validation' => 'Validazione interna degli elaborati prodotti',
        ];

        foreach ($fields as $phase) {
            if (in_array($phase, $selected)) {
                self::create([
                    'client_id' => $formData['id_client'],
                    'project_id' => $projectId,
                    'user' => auth()->user()->name . ' ' . auth()->user()->last_name,
                    'status' => 'In attesa',
                    'name_phase' => $labels[$phase] ?? $phase,

                    'data' => in_array('data', $selected),
                    'user_data' => $formData['user_data'] ?? null,
                    'status_data' => false,

                    'foreman_docs' => in_array('foreman_docs', $selected),
                    'user_foreman_docs' => $formData['user_foreman_docs'] ?? null,
                    'status_foreman_docs' => false,

                    'sanding_sample_lab' => in_array('sanding_sample_lab', $selected),
                    'user_sanding_sample_lab' => $formData['user_sanding_sample_lab'] ?? null,
                    'status_sanding_sample_lab' => false,

                    'data_validation' => in_array('data_validation', $selected),
                    'user_data_validation' => $formData['user_data_validation'] ?? null,
                    'status_data_validation' => false,

                    'internal_validation' => in_array('internal_validation', $selected),
                    'user_internal_validation' => $formData['user_internal_validation'] ?? null,
                    'status_internal_validation' => false,
                ]);
            }
        }
    }
}
