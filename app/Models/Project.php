<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Estimate;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $fillable = [
        'general_info',
        'estimate',
        'id_client',
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
        'responsible',
        'current_phase',
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

    public function phases()
{
    return $this->hasMany(\App\Models\Phase::class, 'id_project');
}

    public function estimate()
    {
        return $this->belongsTo(Estimate::class, 'phase_id');
    }

    public static function prepareFormData(array $formData): array
    {
        $getNameArea = User::role('responsabile area')->find($formData['id_chief_area'] ?? null);
        $getNameProject = User::role('project manager')->find($formData['id_chief_project'] ?? null);
        $getClient = Client::find($formData['id_client'] ?? null);
        $getEstimate = Estimate::find($formData['estimate'] ?? null);

        $formData['estimate'] = $getEstimate?->serial_number ?? null;
        $formData['chief_area'] = $getNameArea ? $getNameArea->name . ' ' . $getNameArea->last_name : null;
        $formData['chief_project'] = $getNameProject ? $getNameProject->name . ' ' . $getNameProject->last_name : null;
        $formData['responsible'] = $formData['chief_project'];
        $formData['address_client'] = $getClient?->address ?? null;
        $formData['client_status'] = $getClient?->status ?? null;
        $formData['client_name'] = $getClient?->name ?? null;
        $formData['note_client'] = $getClient?->note ?? null;
        $formData['status'] = $formData['client_type'] ?? null;
        $formData['stackholder_id'] = json_encode($formData['stackholder_id'] ?? []);
        $formData['general_info'] = $formData['note'] ?? null;
        $formData['starting_price'] = $formData['starting_price'] !== '' ? (float) $formData['starting_price'] : null;
        $formData['discount_percentage'] = $formData['discount_percentage'] !== '' ? (float) $formData['discount_percentage'] : null;
        $formData['discounted'] = $formData['discounted'] !== '' ? (float) $formData['discounted'] : null;
        $formData['total_budget'] = $formData['total_budget'] !== '' ? (float) $formData['total_budget'] : null;

        return $formData;
    }
}
