<?php

namespace App\Livewire;

use Livewire\Component;

class CollapsibleMenu extends Component
{
    public $expanded = false;
    public $isMenuOpen = false;
    public $isMenuOpenLivewire = false;
    public $selected = null;
    protected $listeners = ['toggleExpanded'];

    public function toggleMenu()
    {
        $this->isMenuOpenLivewire = !$this->isMenuOpenLivewire;
    }
    
    public function toggleExpanded()
    {
        $this->expanded = !$this->expanded;
    }

    public function closeMenu()
    {
        $this->isMenuOpen = false;
    }

    public function render()
    {
        return view('livewire.collapsible-menu');
    }
}
