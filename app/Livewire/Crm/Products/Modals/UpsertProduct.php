<?php

namespace App\Livewire\Crm\Products\Modals;

use App\Enums\MeasurementUnitEnum;
use App\Enums\ParentProductCategoryEnum;
use App\Livewire\Crm\Products\Forms\ProductForm;
use App\Models\Product;
use Flux\Flux;
use Illuminate\View\View;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class UpsertProduct extends ModalComponent
{
    public ProductForm $productForm;
    public ?Product $product = null;
    public bool $isEdit = false;

    public function mount(): void
    {
        if ($this->product) {
            $this->productForm->setProduct($this->product);
            $this->isEdit = true;
        }
    }

    public function save()
    {
        if ($this->isEdit) {
            $this->form->update($this->product);
            Flux::toast(
                text: "Servizio aggiornato con successo.",
                variant: 'success',
            );
        } else {
            $this->form->store();
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
        if($this->productForm->category){
            $this->productForm->unique_code = generateUniqueCode(
                Product::class,
                'unique_code',
                $this->productForm->category,
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
            'categories' => ParentProductCategoryEnum::valuesArray(),
            'udms' => MeasurementUnitEnum::valuesArray(),
        ]);
    }
}