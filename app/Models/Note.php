<?php

namespace App\Models;

use App\Models\HistoryClient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use RichanFongdasen\EloquentBlameable\BlameableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Note extends Model
{
    use HasFactory, BlameableTrait;

    protected $fillable = [
        'client_id',
        'content',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

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
}
