<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referent extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'name',
        'last_name',
        'title',
        'job_position',
        'email',
        'telephone',
        'note',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('emailCommunicationFile')
            ->acceptsMimeTypes([
                'application/pdf',
                'application/msword',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'application/vnd.ms-excel',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            ])->useDisk('public')
            ->singleFile();  
    }

    public function getFullNameAttribute()
    {
        return "{$this->last_name} {$this->name}";
    }
}