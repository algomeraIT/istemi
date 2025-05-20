<?php

namespace App\Livewire\Crm\Products\Forms;

use App\Enums\MeasurementUnitEnum;
use App\Models\Product;
use Livewire\Form;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;

class ProductForm extends Form
{
    /**
     * @var Product|null
     */
    public ?Product $product = null;

    #[Validate('required')]
    public $product_category_id = null;

    #[Validate('required|string|max:255')]
    public $title = '';

    #[Validate('required|string')]
    public $uom = null;

    #[Validate('nullable|string')]
    public $description = '';

    #[Validate('required|numeric|min:0')]
    public $price = 0.00;

    #[Validate('boolean')]
    public $is_active = true;

    #[Validate('boolean')]
    public $is_cnpaia = true;

    #[Validate('required|string')]
    public $unique_code = null;


    public function setProduct(Product $product): void
    {
        $this->product = $product;

        foreach (array_keys($this->except('product')) as $field) {
            $this->{$field} = $product->{$field};
        }
    }

    public function store()
    {
        $this->validate();

        rescue(function () use (&$product) {
            return $product = Product::create($this->except('product',));
        }, function ($e) {
            return $e->getMessage();
        });

        return $product;
    }

    public function update():bool
    {
        $this->validate();

        return rescue(function ()  {
            return $this->product->update($this->except('product'));
        }, function ($e) {
            return false;
        });

    }

}