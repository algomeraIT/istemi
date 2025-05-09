<?php

namespace App\Livewire\Crm;

use Livewire\Component;
use App\Models\Client;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Livewire\WithFileUploads;


class Clients extends Component
{
    use WithPagination, WithoutUrlPagination, WithFileUploads;

    public $clientStatus;

    public $client_id, $service, $provenance, $logo_path, $tax_code, $name, $email, $pec, $first_telephone, $second_telephone, $registered_office_address, $sales_manager, $address, $country,$province, $sdi, $site, $user_id_creation, $name_user_creation, $last_name_user_creation, $has_referent, $has_sales, $note;

    public $isOpen, $isOpenShow = false;
    public bool $isModalOpen = false;
    public $activeTab = 'list';

    public $city = '';
    public $label = '';
    public $logo;
    public $logoPreview;
    public $status = '';
    public $date = '';
    public $query = '';
    public $year = '';
    public $lead = '';
    public $assigned_sales_manager = '';

    public function mount($status)
    {
        $this->clientStatus = strtolower($status);;
    }


    protected function rules()
    {
        return [
            'name'    => 'required|string',
            'first_telephone' => 'required|string',
            'email'           => 'required|email',
        ];
    }

    public function getClientStatusPluralProperty()
    {
        return match ($this->clientStatus) {
            'lead'     => 'Lead',
            'contatto' => 'Contatti',
            'cliente'  => 'Clienti',
            default    => $this->clientStatus, // fallback
        };
    }

    public function copy($text)
    {
        $this->dispatch('copyLink', [
            'text' => $text
        ]);
    }



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

    public function create()
    {
        $this->resetFields();
        $this->isOpen = true;
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id);
        $this->client_id = $id;
        $this->logo_path = $client->logo_path;
        $this->tax_code = $client->tax_code;
        $this->name = $client->name;
        $this->email = $client->email;
        $this->pec = $client->pec;
        $this->first_telephone = $client->first_telephone;
        $this->second_telephone = $client->second_telephone;
        $this->registered_office_address = $client->registered_office_address;
        $this->address = $client->address;
        $this->province = $client->province;
        $this->city = $client->city;
        $this->country = $client->country;
        $this->sdi = $client->sdi;
        $this->site = $client->site;
        $this->label = $client->label;
        $this->user_id_creation = $client->user_id_creation;
        $this->name_user_creation = $client->name_user_creation;
        $this->last_name_user_creation = $client->last_name_user_creation;
        $this->has_referent = $client->has_referent;
        $this->has_sales = $client->has_sales;
        $this->sales_manager = $client->sales_manager;
        $this->status = $client->status;
        $this->isOpen = true;
    }

    // public function storeSaleManager()
    // {
    //     $this->validate([
    //         'assigned_sales_manager' => 'required|string|max:255',
    //     ]);

    //     if ($this->lead) {
    //         $this->lead->update([
    //             'sales_manager' => $this->assigned_sales_manager,
    //             'status' => 2
    //         ]);

    //         session()->flash('success', 'Commerciale assegnato con successo.');
    //     }
    // }



    public function closeModal()
    {
        $this->isOpen = false;
        $this->isOpenShow = false;
        $this->resetFields();
    }

    private function resetFields()
    {
        $this->client_id = null;
        $this->name = '';
        $this->email = '';
        $this->pec = '';
        $this->service = '';
        $this->provenance = '';
        $this->registered_office_address = '';
        $this->first_telephone = '';
        $this->second_telephone = '';
        $this->sales_manager = '';
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

    public function goToDetail($clientId)
    {
        if ($this->clientStatus == 'lead') {
            $this->lead = Client::findOrFail($clientId);
            $this->isOpenShow = true;    
        } elseif ($this->clientStatus == 'contatto') {
            return redirect()->route('crm.contact-detail', ['id' => $clientId]);
        } else {
            return redirect()->route('crm.client-detail', ['id' => $clientId]);
        }
      
    }

    public function render()
    {
        $query = Client::where('status', $this->clientStatus)
            // ->when($this->status, fn($q) => $q->where('status', $this->status))
            // ->when($this->year, fn($q) => $q->whereYear('created_at', $this->year))
            // ->when($this->query, fn($q) => $q->where('name', 'like', '%' . $this->query . '%'))
            ->latest();
        
        return view('livewire.crm.clients', [
            'cities' => Client::select('city')->distinct()->pluck('city'),
            'statuses' => Client::select('status')->distinct()->pluck('status'),
            'sale_managers' => Client::select('sales_manager')->distinct()->pluck('sales_manager'),
            'client_cards' => $query->get(),
            'clients' => $query->paginate(12),
        ]);
    }
}
