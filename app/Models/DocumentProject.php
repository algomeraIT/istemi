<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class DocumentProject extends Model
{
    use HasFactory, InteractsWithMedia;
    protected $table = 'document_projects';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int,string>
     */
    protected $fillable = [
        'document_name',
        'media_id',
        'phase',
        'user_id',
        'user_name',
        'status',
    ];
}
