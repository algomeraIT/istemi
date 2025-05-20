<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MicroTaskNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'note',
        'id_task',
        'id_user',
        'status',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class, 'id_task');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}