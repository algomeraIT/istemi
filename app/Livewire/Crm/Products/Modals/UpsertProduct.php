<?php

namespace App\Livewire\Crm\Products\Modals;

use App\Enums\MeasurementUnitEnum;
use App\Livewire\Crm\Products\Forms\ProductForm;
use App\Models\Product;
use App\Models\ProductCategory;
use Flux\Flux;
use Illuminate\View\View;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class UpsertProduct extends ModalComponent
{
    public ProductForm $productForm;
    public ?Product $product = null;
    public bool $isEdit = false;
    public $productCategories;

    public function mount(): void
    {
        $this->productCategories = ProductCategory::all();

        if ($this->product) {
            $this->productForm->setProduct($this->product);
            $this->isEdit = true;
        }
    }

    public function updateOrCreate()
    {
        if ($this->isEdit) {
            $this->productForm->update();
            Flux::toast(
                text: "Servizio aggiornato con successo.",
                variant: 'success',
            );
        } else {
            $this->productForm->store();
            Flux::toast(
                text: "Nuovo servizio creato con successo.",
                variant: 'success',
            );
        }

        $this->closeModal();
        $this->dispatch('refresh');
    }

    /**
     * @return string
     *  Supported: 'sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl', '7xl'
     */
    public static function modalMaxWidth(): string
    {
        return '7xl';
    }

    public function getModalTitle(): string
    {
        return $this->isEdit ? 'Modifica servizio' : 'Aggiungi servizio';
    }

    public function updatedProductFormTitle(): void
    {
        if($this->productForm->product_category_id ){
            $this->productForm->unique_code = generateUniqueCode(
                Product::class,
                'unique_code',
                ProductCategory::find($this->productForm->product_category_id)->name,
                $this->productForm->title
            );
        }
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.crm.products.modals.upsert-product', [
            'categories' => $this->productCategories,
            'uoms' => MeasurementUnitEnum::valuesArray(),
        ]);
    }
}