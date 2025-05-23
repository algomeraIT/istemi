<?php

namespace App\Models;

use App\Models\HistoryClient;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use RichanFongdasen\EloquentBlameable\BlameableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Email extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, BlameableTrait;

    protected $fillable = [
        'client_id',
        'sent_by',
        'to',
        'subject',
        'body',
    ];

    protected $casts = [
        'to' => 'array',
    ];

    protected static function booted()
    {
        static::created(function ($email) {
            HistoryClient::create([
                'client_id' => $email->client_id,
                'type'      => 'email',
                'action'    => 'create',
                'model_id'  => $email->id,
                'status_client' => $email->client->step,
            ]);
        });

        static::updated(function ($email) {
            HistoryClient::create([
                'client_id' => $email->client_id,
                'type'      => 'email',
                'action'    => 'update',
                'model_id'  => $email->id,
                'status_client' => $email->client->step,
            ]);
        });

        static::deleted(function ($email) {
            HistoryClient::create([
                'client_id' => $email->client_id,
                'type'      => 'email',
                'action'    => 'delete',
                'model_id'  => $email->id,
                'status_client' => $email->client->step,
            ]);
        });
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function sendBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sent_by');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function to()
    {
        return User::whereIn('email', $this->to ?? [])->get();
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('attached')
            ->useDisk('public');
    }
}
