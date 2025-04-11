<?php

namespace App\Http\Livewire\Crm;

use Livewire\Component;
use App\Models\Sale;
use Livewire\WithPagination;

class Sales extends Component
{
    use WithPagination;

    public $sales_id, $client_id, $invoice, $price, $status;
    public $isOpenSale = false;
    public $showModal = false;
    public $editing = false;
    public $selectedSale;
    public $sales = [];

    protected $rules = [
        'client_id' => 'required|exists:clients,id',
        'invoice' => 'required|string',
        'price' => 'required|numeric',
        'status' => 'required|string',
    ];

    public function mount($client)
    {
        $this->client_id = $client->id;
        $this->client = $client;
    }

    public function render()
    {
        return view('livewire.crm.sales', [
            'sales' => Sale::where('client_id', $this->client->id)->paginate(10),
            'isOpenSale' => $this->isOpenSale 
        ]);
    }

    public function store()
    {
        $this->validate();

        Sale::updateOrCreate(
            ['id' => $this->sales_id],
            [
                'client_id' => $this->client_id,
                'invoice' => $this->invoice,
                'price' => $this->price,
                'status' => $this->status,
            ]
        );

        session()->flash('message', $this->sales_id ? 'Sale updated successfully!' : 'Sale created successfully!');
        $this->closeModal();
    }

    public function edit($id)
    {
        $this->editing = true;
        $sale = Sale::findOrFail($id);
        $this->sales_id = $sale->id;
        $this->client_id = $sale->client_id;
        $this->invoice = $sale->invoice;
        $this->price = $sale->price;
        $this->status = $sale->status;

        $this->showModal = true;
    }

    public function showDetails($id)
    {
        $this->selectedSale = Sale::findOrFail($id);
        $this->showModal = true;
    }

    public function openModalSale()
    {
        $this->resetFields();
        $this->isOpenSale = true;
    }
    public function closeModalSale()
    {
        $this->showModal = false;
        $this->selectedReferent = null;
        $this->isOpenSale = false;
        $this->resetFields();
    }

    public function delete($id)
    {
        Sale::findOrFail($id)->delete();
        session()->flash('message', 'Sale deleted successfully!');
    }
}