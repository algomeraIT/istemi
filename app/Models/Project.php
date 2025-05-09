<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $fillable = [
        'general_info',
        'n_file',
        'name_project',
        'clients_id',
        'client_name',
        'logo_path_client',
        'client_type',
        'note_client',
        'address_client',
        'client_status',
        'is_from_agent',
        'total_budget',
        'chief_area',
        'chief_project',
        'start_at',
        'end_at',
        'starting_price',
        'discount_percentage',
        'discounted',
        'n_firms',
        'firms_and_percentage',
        'note',
        'is_archived',
        'status',
        'goals',
        'project_scope',
        'expected_results',
        'stackholder_id',
        'phase_id',
        'responsible',
        'current_phase'
    ];


    // A project belongs to a client
    public function client()
    {
        return $this->belongsTo(Client::class, 'clients_id');
    }

    // A project belongs to a stackholder
    public function stackholder()
    {
        return $this->belongsTo(Stackholder::class, 'stackholder_id');
    }

    // A project belongs to a phase
    public function phase()
    {
        return $this->belongsTo(Phase::class, 'phase_id');
    }
}