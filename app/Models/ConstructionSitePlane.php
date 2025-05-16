<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConstructionSitePlane extends Model
{
    use HasFactory;

    protected $table = 'construction_site_plane';

    protected $fillable = [
        'client_id',
        'project_id',
        'name_phase',
        'user',
        'status',
        'construction_site_plane',
        'user_construction_site_plane',
        'status_construction_site_plane',

        'inspection',
        'user_inspection',
        'status_inspection',

        'travel',
        'user_travel',
        'status_travel',

        'site_pass',
        'user_site_pass',
        'status_site_pass',

        'ztl',
        'user_ztl',
        'status_ztl',

        'supplier',
        'user_supplier',
        'status_supplier',

        'timetable',
        'user_timetable',
        'status_timetable',

        'security',
        'user_security',
        'status_security',
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

    public function userConstructionSitePlane()
    {
        return $this->belongsTo(User::class, 'user_construction_site_plane');
    }

    public function userInspection()
    {
        return $this->belongsTo(User::class, 'user_inspection');
    }

    public function userTravel()
    {
        return $this->belongsTo(User::class, 'user_travel');
    }

    public function userSitePass()
    {
        return $this->belongsTo(User::class, 'user_site_pass');
    }

    public function userZtl()
    {
        return $this->belongsTo(User::class, 'user_ztl');
    }

    public function userSupplier()
    {
        return $this->belongsTo(User::class, 'user_supplier');
    }

    public function userTimetable()
    {
        return $this->belongsTo(User::class, 'user_timetable');
    }

    public function userSecurity()
    {
        return $this->belongsTo(User::class, 'user_security');
    }

    public static function createFromPhases(array $formData, array $selected, int $projectId): void
    {
        $fields = ['inspection', 'travel', 'site_pass', 'ztl', 'supplier', 'timetable', 'security'];

        $labels = [
            'inspection' => 'Ispezione',
            'travel' => 'Trasferte',
            'site_pass' => 'Permessi/pass accesso al sito',
            'ztl' => 'Permessi/pass ZTL',
            'supplier' => 'Selezione fornitori',
            'timetable' => 'Cronoprogramma',
            'security' => 'Sicurezza',
        ];

        foreach ($fields as $phase) {
            if (in_array($phase, $selected)) {
                self::create([
                    'client_id' => $formData['id_client'],
                    'project_id' => $projectId,
                    'user' => auth()->user()->name . ' ' . auth()->user()->last_name,
                    'status' => 'In attesa',
                    'name_phase' => $labels[$phase] ?? $phase,

                    'construction_site_plane' => in_array('construction_site_plane', $selected),
                    'user_construction_site_plane' => $formData['user_construction_site_plane'] ?? null,
                    'status_construction_site_plane' => false,

                    'inspection' => in_array('inspection', $selected),
                    'user_inspection' => $formData['user_inspection'] ?? null,
                    'status_inspection' => false,

                    'travel' => in_array('travel', $selected),
                    'user_travel' => $formData['user_travel'] ?? null,
                    'status_travel' => false,

                    'site_pass' => in_array('site_pass', $selected),
                    'user_site_pass' => $formData['user_site_pass'] ?? null,
                    'status_site_pass' => false,

                    'ztl' => in_array('ztl', $selected),
                    'user_ztl' => $formData['user_ztl'] ?? null,
                    'status_ztl' => false,

                    'supplier' => in_array('supplier', $selected),
                    'user_supplier' => $formData['user_supplier'] ?? null,
                    'status_supplier' => false,

                    'timetable' => in_array('timetable', $selected),
                    'user_timetable' => $formData['user_timetable'] ?? null,
                    'status_timetable' => false,

                    'security' => in_array('security', $selected),
                    'user_security' => $formData['user_security'] ?? null,
                    'status_security' => false,
                ]);
            }
        }
    }
}
