<?php

namespace App\Livewire\Crm;

use Exception;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Client as ModelClient;

class Client extends Component
{
    use WithPagination, WithFileUploads;

    public $client_id, $logo_path, $tax_code, $name, $email, $pec, $first_telephone, $second_telephone, $registered_office_address, $sales_manager, $address, $country,$province, $sdi, $site, $user_id_creation, $name_user_creation, $last_name_user_creation, $has_referent, $has_sales;

    public $status = '';
    public $city = '';
    public $label = '';
    public $logo;
    public $logoPreview;

    public $isOpen = false;
    protected $paginationTheme = 'tailwind';

    public $activeTab = 'list';
    #[Url(as: 'currentTab', except: 'list')]
    //public $status = '';
    public $date = '';
    public $query = '';

    public function resetFilters()
    {
        $this->status = '';
        $this->city = '';
        $this->label = '';
        $this->date = '';
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
       
        $baseQuery = ModelClient::query()
            ->when($this->status !== "", fn($q) => $q->where('status', $this->status))
            ->when($this->city !== "", fn($q) => $q->where('city', $this->city))
            ->when(!empty($this->year), fn($q) => $q->whereYear('created_at', $this->year))
            ->when($this->query, fn($q) => $q->where('name', 'like', '%' . $this->query . '%'));

        return view('livewire.crm.clients', [
            'client_kanban' => (clone $baseQuery)->get(),
            'clients' => $baseQuery->paginate(12),
            'statuses' => ModelClient::select('status')->distinct()->pluck('status'),
            'cities' => ModelClient::select('city')->distinct()->pluck('city'),
        ]);

    }

    public function create()
    {
        $this->resetFields();
        $this->isOpen = true;
    }

    public function goToDetail($clientId)
    {
        return redirect()->route('crm.client-detail', ['id' => $clientId]);
    }
    public function edit($id)
    {
        $client = ModelClient::findOrFail($id);
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

    public function updatedLogo()
    {
        $this->validate([
            'logo' => 'image|max:2048',
        ]);

        $this->logoPreview = $this->logo->temporaryUrl();
    }

    public function store()
    {
        DB::beginTransaction();
        try {
            $this->validateClientData();

            $client = ModelClient::updateOrCreate(
                ['id' => $this->client_id],
                $this->getClientData()
            );

            if ($this->logo) {
                $client->clearMediaCollection('clientLogo');
                $client->addMedia($this->logo)
                    ->toMediaCollection('clientLogo');

                $client->logo_path = $client->getFirstMediaUrl('clientLogo');
                $client->save();
            }

            DB::commit();
            session()->flash('message', $this->client_id ? 'Cliente modificato con successo!' : 'Cliente creato con successo!');
            $this->closeModal();

            return;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Errore durante la creazione/modifica cliente: ' . $e->getMessage());

            session()->flash('error', 'Si è verificato un errore...');
        }
    }

    public function removeLogo()
    {
        $this->logo = null;
        $this->logoPreview = null;
    }
    private function validateClientData()
    {
        $this->validate([
            'logo' => 'nullable|image|max:2048',
        ]);
    }

    private function getClientData()
    {
        return [
            'tax_code' => $this->tax_code,
            'name' => $this->name,
            'email' => $this->email,
            'pec' => $this->pec,
            'first_telephone' => $this->first_telephone,
            'second_telephone' => $this->second_telephone,
            'registered_office_address' => $this->registered_office_address,
            'address' => $this->address,
            'province' => $this->province,
            'city' => $this->city,
            'country' => $this->country,
            'sdi' => $this->sdi,
            'site' => $this->site,
            'label' => $this->label,
            'user_id_creation' => $this->user_id_creation,
            'name_user_creation' => $this->name_user_creation,
            'last_name_user_creation' => $this->last_name_user_creation,
            'has_referent' => (bool) $this->has_referent,
            'has_sales' => (bool) $this->has_sales,
            'sales_manager' => $this->sales_manager,
            'status' => filter_var($this->status, FILTER_VALIDATE_BOOLEAN),
        ];
    }

    public function delete($id)
    {
        if ($client = ModelClient::find($id)) {
            $client->delete();
            session()->flash('message', 'Elemento cancellato con successo!');
        } else {
            session()->flash('error', 'Cliente non trovato.');
        }
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
        $this->client_id = null;
        $this->logo_path = '';
        $this->tax_code = '';
        $this->name = '';
        $this->email = '';
        $this->pec = '';
        $this->first_telephone = '';
        $this->second_telephone = '';
        $this->registered_office_address = '';
        $this->address = '';
        $this->province = '';
        $this->city = '';
        $this->country = '';
        $this->sdi = '';
        $this->site = '';
        $this->label = '';
        $this->user_id_creation = '';
        $this->name_user_creation = '';
        $this->last_name_user_creation = '';
        $this->has_referent = '';
        $this->has_sales = '';
        $this->sales_manager = '';
        $this->status = '';
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
