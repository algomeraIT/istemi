<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'project_id',
        'name_phase',
        'user',
        'status',

        'report',
        'user_report',
        'status_report',

        'create_note',
        'user_create_note',
        'status_create_note',

        'sending_note',
        'user_sending_note',
        'status_sending_note',
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

    public function reportUser()
    {
        return $this->belongsTo(User::class, 'user_report');
    }

    public function createNoteUser()
    {
        return $this->belongsTo(User::class, 'user_create_note');
    }

    public function sendingNoteUser()
    {
        return $this->belongsTo(User::class, 'user_sending_note');
    }

    public static function createFromPhases(array $formData, array $selected, int $projectId): void
    {
        $fields = ['report', 'create_note', 'sending_note'];

        $labels = [
            'create_note' => 'Predisposizione di nota di trasmissione',
            'sending_note' => 'Invio nota di trasmissione',
        ];

        foreach ($fields as $phase) {
            if (in_array($phase, $selected)) {
                self::create([
                    'client_id' => $formData['id_client'],
                    'project_id' => $projectId,
                    'user' => auth()->user()->name . ' ' . auth()->user()->last_name,
                    'status' => 'In attesa',
                    'name_phase' => $labels[$phase] ?? $phase,

                    'report' => in_array('report', $selected),
                    'user_report' => $formData['user_report'] ?? null,
                    'status_report' => false,

                    'create_note' => in_array('create_note', $selected),
                    'user_create_note' => $formData['user_create_note'] ?? null,
                    'status_create_note' => false,

                    'sending_note' => in_array('sending_note', $selected),
                    'user_sending_note' => $formData['user_sending_note'] ?? null,
                    'status_sending_note' => false,
                ]);
            }
        }
    }
}
