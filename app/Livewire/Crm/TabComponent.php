<?php

// app/Http/Livewire/TabComponent.php
namespace App\Http\Livewire;

use App\Models\AccountingInvoice;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Referent;
use App\Models\Sale;
use App\Models\Accounting;
use App\Models\Communication;
use App\Models\Clients; // 

class TabComponent extends Component
{
    use WithPagination;

    public $client_id; 
    public $selectedTab = 'referents'; 
    public $isModalOpen = false;
    public $editing = false;
    public $modalData = [];

    public $referentId, $saleId, $accountingId, $communicationId;

    protected $rules = [
        'modalData.name' => 'required|string',
        'modalData.email' => 'required|email',
    ];

    public function mount($client_id)
    {
        $this->client_id = $client_id;
    }

    public function render()
    {
        return view('livewire.tab-component', [
            'referents' => Referent::where('client_id', $this->client_id)->paginate(10),
            'sales' => Sale::where('client_id', $this->client_id)->paginate(10),
            'accountings' => AccountingInvoice::where('client_id', $this->client_id)->paginate(10),
            'communications' => Communication::where('client_id', $this->client_id)->paginate(10),
        ]);
    }

    public function openModal($tab, $id = null)
    {
        $this->selectedTab = $tab;
        $this->reset(['modalData', 'referentId', 'saleId', 'accountingId', 'communicationId']);
        
        if ($id) {
            $this->editing = true;
            $this->loadDataForEdit($id);
        } else {
            $this->editing = false;
        }

        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    public function save()
    {
        $this->validate();

        try {
            $data = array_merge($this->modalData, ['client_id' => $this->client_id]);

            switch ($this->selectedTab) {
                case 'referents':
                    Referent::updateOrCreate(
                        ['id' => $this->referentId],
                        $data
                    );
                    break;

                case 'sales':
                    Sale::updateOrCreate(
                        ['id' => $this->saleId],
                        $data
                    );
                    break;

                case 'accounting':
                    AccountingInvoice::updateOrCreate(
                        ['id' => $this->accountingId],
                        $data
                    );
                    break;

                case 'communications':
                    Communication::updateOrCreate(
                        ['id' => $this->communicationId],
                        $data
                    );
                    break;
            }
            session()->flash('message', 'Record saved successfully!');
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while saving: ' . $e->getMessage());
        }

        $this->closeModal();
    }

    private function loadDataForEdit($id)
    {
        switch ($this->selectedTab) {
            case 'referents':
                $referent = Referent::findOrFail($id);
                $this->modalData = $referent->toArray();
                $this->referentId = $referent->id;
                break;

            case 'sales':
                $sale = Sale::findOrFail($id);
                $this->modalData = $sale->toArray();
                $this->saleId = $sale->id;
                break;

            case 'accounting':
                $accounting = AccountingInvoice::findOrFail($id);
                $this->modalData = $accounting->toArray();
                $this->accountingId = $accounting->id;
                break;

            case 'communications':
                $communication = Communication::findOrFail($id);
                $this->modalData = $communication->toArray();
                $this->communicationId = $communication->id;
                break;
        }
    }

    public function delete($tab, $id)
    {
        try {
            switch ($tab) {
                case 'referents':
                    Referent::findOrFail($id)->delete();
                    break;

                case 'sales':
                    Sale::findOrFail($id)->delete();
                    break;

                case 'accounting':
                    AccountingInvoice::findOrFail($id)->delete();
                    break;

                case 'communications':
                    Communication::findOrFail($id)->delete();
                    break;
            }
            session()->flash('message', 'Record deleted successfully!');
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while deleting: ' . $e->getMessage());
        }
    }
}