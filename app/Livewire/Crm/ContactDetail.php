<?php

namespace App\Http\Livewire\Crm;

use App\Models\Contact;
use App\Models\Clients;
use App\Models\Estimate;
use Livewire\Component;
use Livewire\WithPagination;

class ContactDetail extends Component
{
    use WithPagination;

    public Clients $client;

    public string $query_estimate  = '';
    public string $status_estimate = '';

    public bool $isEstimateModalOpen = false;

    public function mount($id)
    {
        $this->client = $client_id->id;
    }

    public function updatingQueryEstimate()   { $this->resetPage(); }
    public function updatingStatusEstimate()  { $this->resetPage(); }

    public function openNewEstimateModal()
    {
        $this->resetValidation();
        $this->isEstimateModalOpen = true;
    }

    public function closeEstimateModal()
    {
        $this->isEstimateModalOpen = false;
    }

    public function render()
    {
        $estimates = Estimate::where('client_id', $this->client->id)
            ->when($this->query_estimate, fn($q) =>
                $q->where('serial_number', 'like', '%'.$this->query_estimate.'%')
            )
            ->when($this->status_estimate !== '', fn($q) =>
                $q->where('status', $this->status_estimate)
            )
            ->latest()
            ->paginate(10);

        return view('livewire.crm.contact-detail', compact('estimates'));
    }
}