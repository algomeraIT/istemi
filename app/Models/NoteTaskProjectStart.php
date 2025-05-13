<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoteTaskProjectStart extends Model
{
    use HasFactory;

    protected $table = 'note_task_project_start';

    protected $fillable = [
        'task_id',
        'project_id',
        'note',
        'attachment',
    ];

    protected $casts = [
        'attachment' => 'array',
    ];
}