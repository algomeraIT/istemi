<?php

namespace App\Models;

use App\Models\HistoryClient;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use RichanFongdasen\EloquentBlameable\BlameableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Call extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, BlameableTrait;

    protected $fillable = [
        'client_id',
        'content',
    ];

    protected static function booted()
    {
        static::created(function ($note) {
            HistoryClient::create([
                'client_id' => $note->client_id,
                'type'      => 'note',
                'action'    => 'create',
                'model_id'  => $note->id,
                'status_client' => $note->client->step,
            ]);
        });

        static::updated(function ($note) {
            HistoryClient::create([
                'client_id' => $note->client_id,
                'type'      => 'note',
                'action'    => 'update',
                'model_id'  => $note->id,
                'status_client' => $note->client->step,
            ]);
        });

        static::deleted(function ($note) {
            HistoryClient::create([
                'client_id' => $note->client_id,
                'type'      => 'note',
                'action'    => 'delete',
                'model_id'  => $note->id,
                'status_client' => $note->client->step,
            ]);
        });
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('attached')
            ->useDisk('public');
    }
}
