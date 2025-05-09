<?php

namespace App\Livewire\Crm;

use App\Models\Contact;
use App\Models\Estimate;
use Livewire\Component;
use Livewire\WithPagination;

class Contacts extends Component
{
    use WithPagination;

    public $lead_id, $name, $email, $pec, $registered_office_address, $first_telephone, $second_telephone;

    public $isOpen = false;
    protected $paginationTheme = 'tailwind';

    public $activeTab = 'list';
    #[Url(as: 'currentTab', except: 'list')]
    public $status = '';
    public $date = '';
    public $query = '';
    public $year = '';

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

    public function goToDetail($contactId)
    {
        return redirect()->route('crm.contact-detail', ['id' => $contactId]);
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
        $baseQuery = Contact::query()
            ->when($this->status !== "", fn($q) => $q->where('status', $this->status))
            ->when(!empty($this->year), fn($q) => $q->whereYear('created_at', $this->year))
            ->when($this->query, fn($q) => $q->where('name', 'like', '%' . $this->query . '%'));

        return view('livewire.crm.contacts', [
            'contact_kanban' => (clone $baseQuery)->latest()->get(),
            'contacts' => $baseQuery->latest()->paginate(12),
            'statuses' => Contact::select('status')->distinct()->pluck('status'),
        ]);
    }

    public function create()
    {
        $this->resetFields();
        $this->isOpen = true;
    }

    public function edit($id)
    {
        $contacts = Contact::findOrFail($id);
        $this->lead_id = $id;
        $this->name = $contacts->name;
        $this->email = $contacts->email;
        $this->pec = $contacts->pec;
        $this->registered_office_address = $contacts->registered_office_address;
        $this->first_telephone = $contacts->first_telephone;
        $this->second_telephone = $contacts->second_telephone;
        $this->isOpen = true;
    }

    public function store()
    {
        Contact::updateOrCreate(['id' => $this->lead_id], [
            'name' => $this->name,
            'email' => $this->email,
            'pec' => $this->pec,
            'registered_office_address' => $this->registered_office_address,
            'first_telephone' => $this->first_telephone,
            'second_telephone' => $this->second_telephone,
        ]);

        session()->flash('message', $this->lead_id ? 'Contatto modificato con successo!' : 'Contatto creato con successo!');

        $this->closeModal();
    }

    public function delete($id)
    {
        Contact::find($id)->delete();
        session()->flash('message', 'Elemento cancellato con successo!');
        $this->resetPage();
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetFields();
    }

    private function resetFields()
    {
        $this->lead_id = null;
        $this->name = '';
        $this->email = '';
        $this->registered_office_address = '';
        $this->first_telephone = '';
        $this->second_telephone = '';
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
