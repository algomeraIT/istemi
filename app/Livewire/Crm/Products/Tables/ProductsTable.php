<?php

namespace App\Livewire\Crm\Products\Tables;

use App\Enums\MeasurementUnitEnum;
use App\Enums\ParentProductCategoryEnum;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use App\Models\Product;
use Flux\Flux;

class ProductsTable extends Component
{
    use WithPagination, WithoutUrlPagination;

    public string $search = '';
    public ?string $filterCategory = null;
    public ?string $filterState = null;
    public ?string $filterUdm = null;
    public string $sortBy = 'unique_code';
    public string $sortDirection = 'asc';

    protected $queryString = [
        'search'         => ['except' => ''],
        'filterCategory' => ['except' => null],
        'filterState'    => ['except' => null],
        'filterUdm'      => ['except' => null],
        'sortBy'         => ['except' => 'unique_code'],
        'sortDirection'  => ['except' => 'asc'],
    ];

    public function updatingSearch() { $this->resetPage(); }
    public function updatingFilterCategory() { $this->resetPage(); }
    public function updatingFilterState()    { $this->resetPage(); }
    public function updatingFilterUdm()      { $this->resetPage(); }

    public function sort($column)
    {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
    }

    public function delete(Product $product)
    {
        $product->delete();

        Flux::toast(
            text: "{$product->title} eliminato.",
            variant: 'warning',
        );
    }

    /**
     * @return View
     */
    public function render(): View
    {
        $query = Product::query()
            ->when($this->search, fn($q) =>
            $q->where('unique_code', 'like', "%{$this->search}%")
                ->orWhere('title', 'like', "%{$this->search}%")
            )
            ->when($this->filterCategory, fn($q) =>
            $q->where('category', $this->filterCategory)
            )
            ->when($this->filterState !== null, fn($q) =>
            $q->where('is_active', $this->filterState === 'attivo')
            )
            ->when($this->filterUdm, fn($q) =>
            $q->where('udm', $this->filterUdm)
            )
            ->orderBy($this->sortBy, $this->sortDirection);

        return view('livewire.crm.products.tables.products-table', [
            'products' => $query->paginate(12),
            'categories' => ParentProductCategoryEnum::valuesArray(),
            'udms'       => MeasurementUnitEnum::valuesArray(),
        ]);
    }
}