<?php

namespace App\Livewire\Crm\Client;

use Flux\Flux;
use App\Models\User;
use App\Models\Client;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Livewire\Forms\ClientForm;
use Livewire\WithoutUrlPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    public ClientForm $clientForm;
    public $clientStatus;

    public $city;
    public $label;
    public $step;
    public $year;
    public $search;

    public $selectedLead;
    public $selected_sales_manager;

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

    public function setLead($id)
    {
        $this->selectedLead = Client::findOrFail($id);

        Flux::modal('show-lead')->show();
    }

    public function assignManager($clientId)
    {
        $this->validate([
            'selected_sales_manager' => 'required|exists:users,id',
        ]);

        $client = Client::findOrFail($clientId);

        $client->update([
            'sales_manager_id' => $this->selected_sales_manager,
            'status' => 'contatto',
            'step' => 'assegnato'
        ]);

        Flux::modals()->close();

        Flux::toast(
            text: "Assegnato Commerciale a {$client->name}.",
            variant: 'success',
        );

        $this->reset('selected_sales_manager');
    }

    public function create()
    {
        $this->clientForm->status = $this->clientStatus;
        $this->clientForm->step = 'nuovo';
        $this->clientForm->store();

        Flux::toast(
            text: "Nuovo {$this->clientStatus} creato con successo.",
            variant: 'success',
        );

        $this->dispatch('refresh');

        Flux::modals()->close();
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

    #[On('refresh')]
    public function render()
    {
        $steps = Client::where('status', $this->clientStatus)->select('step')->distinct()->pluck('step');
        $cities = Client::where('status', $this->clientStatus)->select('city')->distinct()->pluck('city');
        $labels = Client::where('status', $this->clientStatus)->select('label')->distinct()->pluck('label');
        $years = Client::where('status', $this->clientStatus)
            ->selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');
        $salesManager = User::role('commerciale')->get();

        $query = Client::where('status', $this->clientStatus)
            ->when($this->step, fn($q) => $q->where('step', $this->step))
            ->when($this->city, fn($q) => $q->where('city', $this->city))
            ->when($this->label, fn($q) => $q->where('label', $this->label))
            ->when($this->year, fn($q) => $q->whereYear('created_at', $this->year))
            ->when($this->search, fn($q) => $q->filter('name', $this->search))
            ->latest();

        return view('livewire.crm.client.index', [
            'steps' => $steps,
            'cities' => $cities,
            'labels' => $labels,
            'years' => $years,
            'sale_managers' => $salesManager,
            'client_cards' => $query->get(),
            'clients' => $query->paginate(12),
        ]);
    }
}
