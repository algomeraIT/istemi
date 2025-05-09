<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class TaskProjectStart extends Model
{
    use HasFactory;

    protected $table = 'task_project_start';

    protected $fillable = [
        'project_id',
        'client_id',
        'project_start_id',
        'title',
        'assignee',
        'cc',
        'expire',
        'note',
        'media',
        'status',
    ];

    protected $casts = [
        'media' => 'array',
        'expire' => 'date',
    ];

    public function client()
    {
        return $this->belongsTo(Clients::class);
    }

    public function project_start()
    {
        return $this->belongsTo(ProjectStart::class);
    }
}
