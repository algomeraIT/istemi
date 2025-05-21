<?php

namespace App\Models;

use App\Models\HistoryClient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use RichanFongdasen\EloquentBlameable\BlameableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Activity extends Model
{
    use HasFactory, BlameableTrait;

    protected $fillable = [
        'client_id',
        'title',
        'note',
        'status',
        'expiration',
        'completed_at',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function assigned(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withPivot('role');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function booted()
    {
        static::created(function ($activity) {
            HistoryClient::create([
                'client_id' => $activity->client_id,
                'type'      => 'activity',
                'action'    => 'create',
                'model_id'  => $activity->id,
                'status_client' => $activity->client->step,
            ]);
        });

        static::updated(function ($activity) {
            HistoryClient::create([
                'client_id' => $activity->client_id,
                'type'      => 'activity',
                'action'    => 'update',
                'model_id'  => $activity->id,
                'status_client' => $activity->client->step,
            ]);
        });

        static::deleted(function ($activity) {
            HistoryClient::create([
                'client_id' => $activity->client_id,
                'type'      => 'activity',
                'action'    => 'delete',
                'model_id'  => $activity->id,
                'status_client' => $activity->client->step,
            ]);
        });
    }
}
