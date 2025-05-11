<?php

namespace App\Livewire\Crm\Client;

use Flux\Flux;
use App\Models\Client;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $clientStatus;

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

    public function delete($id)
    {
        $client = Client::find($id);
        $client->delete();

        Flux::toast(
            text: "{$client->name} eliminato.",
            variant: 'warning',
        );

        $this->dispatch('refresh');
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

    #[On('refresh')]
    public function render()
    {
        $query = Client::where('status', $this->clientStatus)
            // ->when($this->status, fn($q) => $q->where('status', $this->status))
            // ->when($this->year, fn($q) => $q->whereYear('created_at', $this->year))
            // ->when($this->query, fn($q) => $q->where('name', 'like', '%' . $this->query . '%'))
            ->latest();

        return view('livewire.crm.client.index', [
            'cities' => Client::select('city')->distinct()->pluck('city'),
            'statuses' => Client::select('status')->distinct()->pluck('status'),
            'sale_managers' => Client::select('sales_manager')->distinct()->pluck('sales_manager'),
            'client_cards' => $query->get(),
            'clients' => $query->paginate(12),
        ]);
    }
}
