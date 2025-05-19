<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'id_phases',
        'id_assignee',
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