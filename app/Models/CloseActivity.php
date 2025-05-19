<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CloseActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'project_id',
        'close_activity',
        'name_phase',
        'user',
        'status',
        'user_close_activity',
        'status_close_activity',
        'sale',
        'user_sale',
        'status_sale',
        'release',
        'user_release',
        'status_release',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function userCloseActivity()
    {
        return $this->belongsTo(User::class, 'user_close_activity');
    }

    public function userSale()
    {
        return $this->belongsTo(User::class, 'user_sale');
    }

    public function userRelease()
    {
        return $this->belongsTo(User::class, 'user_release');
    }

    public static function createFromPhases(array $formData, array $selected, int $projectId): void
    {
        $fields = ['close_activity', 'sale', 'release'];

        $labels = [
            'sale' => 'Fatturato specifico',
            'release' => 'Svincolo dalla polizza',
        ];

        foreach ($fields as $phase) {
            if (in_array($phase, $selected)) {
                self::create([
                    'client_id' => $formData['id_client'],
                    'project_id' => $projectId,
                    'user' => auth()->user()->name . ' ' . auth()->user()->last_name,
                    'status' => 'In attesa',
                    'name_phase' => $labels[$phase] ?? $phase,

                    'close_activity' => in_array('close_activity', $selected),
                    'user_close_activity' => $formData['user_close_activity'] ?? null,
                    'status_close_activity' => false,

                    'sale' => in_array('sale', $selected),
                    'user_sale' => $formData['user_sale'] ?? null,
                    'status_sale' => false,

                    'release' => in_array('release', $selected),
                    'user_release' => $formData['user_release'] ?? null,
                    'status_release' => false,
                ]);
            }
        }
    }
}
