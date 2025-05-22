<?php

namespace App\Models;

use Spatie\Image\Enums\Fit;
use App\Models\HistoryClient;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use RichanFongdasen\EloquentBlameable\BlameableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class Client extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, BlameableTrait, SoftDeletes;

    protected $fillable = [
        'parent_id',
        'estimate_id',
        'sales_manager_id',
        'is_company',
        'name',
        'email',
        'client',
        'pec',
        'first_telephone',
        'second_telephone',
        'country',
        'city',
        'province',
        'address',
        'cap',
        'tax_code',
        'p_iva',
        'sdi',
        'site',
        'label',
        'note',
        'service',
        'provenance',
        'registered_office_address',
        'has_referent',
        'status',
        'step',
    ];

    protected static function booted()
    {
        static::created(function ($client) {
            HistoryClient::create([
                'client_id' => $client->id,
                'type'      => 'client',
                'action'    => 'create',
                'model_id'  => $client->id,
                'status_client' => $client->step,
            ]);
        });

        static::updated(function ($client) {
            HistoryClient::create([
                'client_id' => $client->id,
                'type'      => 'client',
                'action'    => 'update',
                'model_id'  => $client->id,
                'status_client' => $client->step,
            ]);
        });

        static::deleted(function ($client) {
            HistoryClient::create([
                'client_id' => $client->id,
                'type'      => 'client',
                'action'    => 'delete',
                'model_id'  => $client->id,
                'status_client' => $client->step,
            ]);
        });
    }

    public function parents()
    {
        return $this->hasMany(Client::class, 'parent_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function salesManager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sales_manager_id');
    }

    public function estimate(): HasMany
    {
        return $this->hasMany(Estimate::class);
    }

    public function referents(): HasMany
    {
        return $this->hasMany(Referent::class);
    }

    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class);
    }

    public function emails(): HasMany
    {
        return $this->hasMany(Email::class);
    }

    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('clientLogo')
            ->useDisk('public')
            ->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        // Preview
        $this->addMediaConversion('preview')
            ->fit(Fit::Crop, 40, 40)
            ->sharpen(10)
            ->background('FFFFFF')
            ->nonOptimized()
            ->nonQueued();
    }

    public function getFullNameAttribute()
    {
        return "{$this->last_name} {$this->name}";
    }
}
