<?php

namespace App\Livewire\Crm;

use App\Models\Contact;
use App\Models\Estimate;
use Livewire\Component;

class ContactDetail extends Component
{
    public $contact;
    public $estimates;

    // Livewire will inject the {id} route param here
    public function mount($id)
    {
        $this->contact = Contact::findOrFail($id);

        // load only this contact’s estimates
        $estimateQuery = Estimate::query()
        ->where('status', '!=', 0)
        ->when($this->status !== "", fn($q) => $q->where('status', $this->status))
        ->when($this->year,         fn($q) => $q->whereYear('created_at', $this->year))
        ->when($this->query,        fn($q) => $q->where('company_name', 'like', "%{$this->query}%"));

        $this->estimates = $estimateQuery
            ->latest()
            ->paginate(12);
    }

    public function render()
    {
        return view('livewire.crm.contact-detail', [
            'contact'   => $this->contact,
            'estimates' => $this->estimates,
        ]);
    }
}