<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Clients extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $table = 'clients';

    protected $fillable = [
        'id',
        'logo_path',
        'tax_code',
        'company_name',
        'email',
        'pec',
        'first_telephone',
        'second_telephone',
        'registered_office_address',
        'address',
        'province',
        'city',
        'country',
        'sdi',
        'site',
        'label',
        'user_id_creation',
        'name_user_creation',
        'last_name_user_creation',
        'has_referent',
        'has_sales',
        'status'
    ];

    /**
     * Get the user who created this client.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(Users::class, 'user_id_creation');
    }

    public function referents()
    {
        return $this->hasMany(Referent::class, 'client_id');
    }
    public function communication()
    {
        return $this->hasMany(Communication::class, 'client_id');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('clientLogo')
            ->useDisk('public')
            ->singleFile();
    }

}