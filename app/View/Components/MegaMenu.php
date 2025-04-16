<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MegaMenu extends Component
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
    public function render(): View|Closure|string
    {
        return view('components.mega-menu');
    }
}
