<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Area extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public $timestamps = false;

    public function microAreas()
    {
        return $this->hasMany(MicroArea::class);
    }
}
