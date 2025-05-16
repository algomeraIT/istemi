<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HistoryClient extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function model()
    {
        return match ($this->type) {
            'client'   => $this->belongsTo(Client::class, 'model_id'),
            'activity' => $this->belongsTo(Activity::class, 'model_id'),
            'email'    => $this->belongsTo(Email::class, 'model_id'),
            'note'     => $this->belongsTo(Note::class, 'model_id'),
        };
    }
}
