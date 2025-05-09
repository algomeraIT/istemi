<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HistoryContact extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'user_id', 'name', 'last_name', 'role',
        'client_id', 'contact_id', 'action', 'estimate_id',
        'note', 'update_status_from_to', 'status',
    ];

    public function user()
    {return $this->belongsTo(User::class);}
    public function client()
    {return $this->belongsTo(Client::class);}
    public function contact()
    {return $this->belongsTo(Contact::class);}
    public function estimate()
    {return $this->belongsTo(Estimate::class);}
}
