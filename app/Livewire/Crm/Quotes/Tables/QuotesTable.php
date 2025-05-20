<?php

namespace App\Livewire\Crm\Quotes\Tables;

use App\Models\Client;
use App\Models\Quote;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Flux\Flux;

class QuotesTable extends Component
{
    use WithPagination, WithoutUrlPagination;

    public string $search = '';
    public ?string $filterClient = null;
    public ?string $filterStatus = null;
    public string $sortBy = 'code';
    public string $sortDirection = 'desc';
    public $clients;

    protected $queryString = [
        'search'         => ['except' => ''],
        'filterClient'   => ['except' => null],
        'filterStatus'   => ['except' => null],
        'sortBy'         => ['except' => 'code'],
        'sortDirection'  => ['except' => 'desc'],
    ];

    public function mount(): void
    {
        $this->clients = Client::where('status', 'cliente')->orderBy('name')->get();
    }

    public function updatingSearch() { $this->resetPage(); }
    public function updatingFilterClient() { $this->resetPage(); }
    public function updatingFilterStatus() { $this->resetPage(); }

    public function sort($column)
    {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
    }

    public function delete(Quote $quote)
    {
        $quote->delete();

        Flux::toast(
            text: "Preventivo {$quote->code} eliminato.",
            variant: 'warning',
        );
    }

    /**
     * @return View
     */
    #[On('refresh')]
    public function render(): View
    {
        $query = Quote::query();

        // Join with client table for better search
        $query->with('client');

        if ($this->search) {
            $query->where(function($q) {
                $q->where('code', 'like', "%{$this->search}%")
                    ->orWhere('subject', 'like', "%{$this->search}%")
                    ->orWhereHas('client', function($query) {
                        $query->where('name', 'like', "%{$this->search}%");
                    });
            });
        }

        // Filter by client
        if (filled($this->filterClient)) {
            $query->where('client_id', $this->filterClient);
        }

        // Filter by status
        if (filled($this->filterStatus)) {
            $query->where('status', $this->filterStatus);
        }

        // Sort
        $query->orderBy($this->sortBy, $this->sortDirection);

        return view('livewire.crm.quotes.tables.quotes-table', [
            'quotes' => $query->paginate(12),
            'clients' => $this->clients,
            'statuses' => [
                'draft' => 'Bozza',
                'review_area' => 'In revisione - R.A.',
                'approved_area' => 'Approvato - R.A.',
                'rejected_area' => 'Rifiutato - R.A.',
                'review_management' => 'In revisione - Direzione',
                'approved_management' => 'Approvato - Direzione',
                'rejected_management' => 'Rifiutato - Direzione',
                'sent' => 'Inviato al cliente',
                'accepted' => 'Approvato dal cliente',
                'rejected' => 'Rifiutato dal cliente',
                'expired' => 'Scaduto'
            ]
        ]);
    }
}