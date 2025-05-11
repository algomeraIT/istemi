<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CloseActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'project_id',
        'close_activity',
        'user',
        'status',
        'user_close_activity',
        'status_close_activity',
        'sale',
        'user_sale',
        'status_sale',
        'release',
        'user_release',
        'status_release',
    ];

    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function project() {
        return $this->belongsTo(Project::class);
    }

    public function userCloseActivity() {
        return $this->belongsTo(User::class, 'user_close_activity');
    }

    public function userSale() {
        return $this->belongsTo(User::class, 'user_sale');
    }

    public function userRelease() {
        return $this->belongsTo(User::class, 'user_release');
    }
}