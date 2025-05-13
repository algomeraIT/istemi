<?php

namespace App\Models;

use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use RichanFongdasen\EloquentBlameable\BlameableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class Client extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, BlameableTrait, SoftDeletes;

    protected $fillable = [
        'parent_id',
        'user_id',
        'estimate_id',
        'sales_manager_id',
        'is_company',
        'name',
        'email',
        'pec',
        'first_telephone',
        'second_telephone',
        'country',
        'city',
        'province',
        'address',
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

    /**
     * Get the user who created this client.
     */
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

    public function estimate()
    {
        return $this->hasMany(Estimate::class);
    }

    public function referents()
    {
        return $this->hasMany(Referent::class);
    }

    public function communication()
    {
        return $this->hasMany(Communication::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('clientLogo')
            ->useDisk('public')
            ->singleFile();
    }
}
