<?php

namespace App\Livewire\Crm\Products\Forms;

use App\Enums\MeasurementUnitEnum;
use App\Enums\ParentProductCategoryEnum;
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

    #[Validate('required|string')]
    public $category = null;

    #[Validate('required|string|max:255')]
    public $title = '';

    #[Validate('required|string')]
    public $udm = null;

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

        $product = Product::create([
            'category' => $this->category,
            'unique_code' => $this->unique_code,
            'title' => $this->title,
            'udm' => $this->udm,
            'description' => $this->description,
            'price' => $this->price,
            'is_active' => $this->is_active,
            'is_cnpaia' => $this->is_cnpaia,
        ]);

        $this->reset();

        return $product;
    }

    public function update(Product $product): Product
    {
        $this->validate();

        $product->update([
            'category' => $this->category,
            'title' => $this->title,
            'udm' => $this->udm,
            'description' => $this->description,
            'price' => $this->price,
            'is_active' => $this->is_active,
            'is_cnpaia' => $this->is_cnpaia,
        ]);

        return $product;
    }

}