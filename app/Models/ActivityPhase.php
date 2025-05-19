<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class ActivityPhase extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'project_id',
        'name_phase',
        'user',
        'status',
        'activities',
        'user_activities',
        'status_activities',

        'team',
        'user_team',
        'status_team',

        'field_activities',
        'user_field_activities',
        'status_field_activities',

        'daily_check_activities',
        'user_daily_check_activities',
        'status_daily_check_activities',

        'contruction_site_media',
        'user_contruction_site_media',
        'status_contruction_site_media',

        'activity_validation',
        'user_activity_validation',
        'status_activity_validation',
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

    public function userActivities()
    {
        return $this->belongsTo(User::class, 'user_activities');
    }

    public function userTeam()
    {
        return $this->belongsTo(User::class, 'user_team');
    }

    public function userFieldActivities()
    {
        return $this->belongsTo(User::class, 'user_field_activities');
    }

    public function userDailyCheckActivities()
    {
        return $this->belongsTo(User::class, 'user_daily_check_activities');
    }

    public function userContructionSiteMedia()
    {
        return $this->belongsTo(User::class, 'user_contruction_site_media');
    }

    public function userActivityValidation()
    {
        return $this->belongsTo(User::class, 'user_activity_validation');
    }

    public static function createFromPhases(array $formData, array $selected, int $projectId): void
    {
        $fields = [
            'activities',
            'team',
            'field_activities',
            'daily_check_activities',
            'contruction_site_media',
            'activity_validation',
        ];

        $labels = [
            'team' => 'Selezione della squadra',
            'field_activities' => 'Impartire istruzioni utili allo svolgimento delle attività in campo',
            'daily_check_activities' => 'Riepilogo giornaliero delle attività eseguite',
            'contruction_site_media' => 'Caricamento dati cantiere',
            'activity_validation' => 'Controllo avanzamento attività/budget (PM)',
        ];
        $user = Auth::user();
        foreach ($fields as $phase) {
            if (in_array($phase, $selected)) {
                self::create([
                    'client_id' => $formData['id_client'],
                    'project_id' => $projectId,
                    'user' => $user->name . ' ' . $user->last_name,
                    'status' => 'In attesa',
                    'name_phase' => $labels[$phase] ?? $phase,

                    'activities' => in_array('activities', $selected),
                    'user_activities' => $formData['user_activities'] ?? null,
                    'status_activities' => false,

                    'team' => in_array('team', $selected),
                    'user_team' => $formData['user_team'] ?? null,
                    'status_team' => false,

                    'field_activities' => in_array('field_activities', $selected),
                    'user_field_activities' => $formData['user_field_activities'] ?? null,
                    'status_field_activities' => false,

                    'daily_check_activities' => in_array('daily_check_activities', $selected),
                    'user_daily_check_activities' => $formData['user_daily_check_activities'] ?? null,
                    'status_daily_check_activities' => false,

                    'contruction_site_media' => in_array('contruction_site_media', $selected),
                    'user_contruction_site_media' => $formData['user_contruction_site_media'] ?? null,
                    'status_contruction_site_media' => false,

                    'activity_validation' => in_array('activity_validation', $selected),
                    'user_activity_validation' => $formData['user_activity_validation'] ?? null,
                    'status_activity_validation' => false,
                ]);
            }
        }
    }
}

