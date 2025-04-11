<?php

namespace App\Livewire\Crm;

use App\Models\Lead;
use Livewire\Component;
use Livewire\WithPagination;
use Purifier;

class Leads extends Component
{
    use WithPagination;

    public $lead_id, $company_name, $email, $pec, $service, $note, $provenance, $registered_office_address, $first_telephone, $second_telephone, $sales_manager, $acquisition_date;

    public $isOpen, $isOpenShow = false;
    protected $paginationTheme = 'tailwind';

    public $activeTab = 'list';
    public $status = '';
    public $date = '';
    public $query = '';
    public $year = '';
    public $lead = '';

    public function resetFilters()
    {
        $this->status = '';
        $this->date = '';
        $this->year = '';
        $this->resetPage();
    }

    public function search()
    {
        $this->resetPage();
    }

    public function setTab($tab)
    {
        $this->activeTab = $tab;
        $this->isOpen = false;
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function updatingDate()
    {
        $this->resetPage();
    }
    public function render()
    {
        $baseQuery = Lead::query()
            ->where('status', '!=', 0)
            ->when($this->status !== "", fn($q) => $q->where('status', $this->status))
            ->when(!empty($this->year), fn($q) => $q->whereYear('created_at', $this->year))
            ->when($this->query, fn($q) => $q->where('company_name', 'like', '%' . $this->query . '%'));

        return view('livewire.crm.leads', [
            'leads_kanban' => (clone $baseQuery)->latest()->get(),
            'leads' => $baseQuery->latest()->paginate(12),
            'statuses' => Lead::select('status')->distinct()->pluck('status'),
        ]);
    }

    public function show($id_lead)
    {
        $this->lead = Lead::findOrFail($id_lead);
        $this->isOpenShow = true;
    }
    public function create()
    {
        $this->resetFields();
        $this->isOpen = true;
    }

    public function edit($id)
    {
        $lead = Lead::findOrFail($id);
        $this->lead_id = $id;
        $this->company_name = $lead->company_name;
        $this->email = $lead->email;
        $this->pec = $lead->pec;
        $this->service = $lead->service;
        $this->note = $lead->note;
        $this->provenance = $lead->provenance;
        $this->registered_office_address = $lead->registered_office_address;
        $this->first_telephone = $lead->first_telephone;
        $this->second_telephone = $lead->second_telephone;
        $this->sales_manager = $lead->sales_manager;
        //$this->acquisition_date = $lead->acquisition_date;
        $this->isOpen = true;
    }

    public function store()
    {
        Lead::updateOrCreate(['id' => $this->lead_id], [
            'company_name' => $this->company_name,
            'email' => $this->email,
            'pec' => $this->pec,
            'service' => $this->service,
            'note' => Purifier::clean($this->note),
            'provenance' => $this->provenance,
            'registered_office_address' => $this->registered_office_address,
            'first_telephone' => $this->first_telephone,
            'second_telephone' => $this->second_telephone,
            'sales_manager' => $this->sales_manager,
            //'acquisition_date' => $this->acquisition_date,
        ]);

        session()->flash('message', $this->lead_id ? 'Lead modificato con successo!' : 'Lead creato con successo!');

        $this->closeModal();
    }

    public function delete($id)
    {
        try {
            $lead = Lead::find($id);

            if (!$lead) {
                session()->flash('error', 'Elemento non trovato!');
                return;
            }

            $lead->update(['status' => 0]);
            session()->flash('message', 'Elemento disattivato con successo!');
        } catch (\Exception $e) {
            session()->flash('error', 'Si è verificato un errore: ' . $e->getMessage());
        }

        $this->resetPage();
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->isOpenShow = false;
        $this->resetFields();
    }

    private function resetFields()
    {
        $this->lead_id = null;
        $this->company_name = '';
        $this->email = '';
        $this->pec = '';
        $this->service = '';
        $this->provenance = '';
        $this->registered_office_address = '';
        $this->first_telephone = '';
        $this->second_telephone = '';
        $this->sales_manager = '';
        $this->acquisition_date = '';
        $this->note = '';
    }

    public function updatedQuery()
    {
        $this->resetPage();
    }

    public function updatedStatus()
    {
        $this->resetPage();
    }

    public function updatedYear()
    {
        $this->resetPage();
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }
}
