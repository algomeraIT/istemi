<?php

namespace App\Livewire\Crm\Products;

use Illuminate\View\View;
use Livewire\Component;

class Index extends Component
{
    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.crm.products.index');
    }
}
