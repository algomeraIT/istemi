<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Task extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'id_phases',
        'id_assignee',
        'status',
        'title',
        'assignee',
        'cc',
        'expire',
        'note',
        'media',
        'status',
    ];

    public function phase()
    {
        return $this->belongsTo(Phase::class, 'id_phases');
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'id_assignee');
    }
}