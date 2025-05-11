<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class Client extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'parent_id',
        'user_id',
        'estimate_id',
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
        'sales_manager',
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
        return $this->belongsTo(User::class);
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
