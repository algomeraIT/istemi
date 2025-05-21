<?php

namespace App\Livewire\Crm\Client;

use Flux\Flux;
use App\Models\Note;
use App\Models\User;
use App\Models\Email;
use App\Models\Client;
use Livewire\Component;
use App\Models\Activity;
use App\Models\Estimate;
use App\Models\Referent;
use Livewire\Attributes\On;
use App\Models\HistoryClient;
use App\Livewire\Forms\ReferentForm;
use App\Livewire\Forms\Client\NoteForm;
use App\Livewire\Forms\Client\EmailForm;
use App\Livewire\Forms\Client\ActivityForm;

// Traits
use App\Livewire\Crm\Client\Traits\ActivityActions;
use App\Livewire\Crm\Client\Traits\ReferentActions;

class Show extends Component
{
    use ActivityActions;
    public ActivityForm $activityForm;

    use ReferentActions;
    public ReferentForm $referentForm;

    public EmailForm $emailForm;
    public NoteForm $noteForm;

    public $client;
    public $references;
    public $communicationType;

    public $tabs = [];
    public $search;


    public function mount($id)
    {
        $this->client = Client::with('user', 'referents', 'estimate')->findOrFail($id);
        $this->setTabs();
    }

    private function setTabs()
    {
        if ($this->client->status == 'cliente') {
            $this->tabs = [
                'referenti',
                // 'commercio',
                // 'contabilità',
                'comunicazioni'
            ];
        } else {
            $this->tabs = [
                // 'storico',
                'comunicazioni',
                // 'preventivi'
            ];
        }
    }

    public function copy($text)
    {
        $this->dispatch('copyLink', [
            'text' => $text
        ]);
    }


    public function newQuote()
    {
        dump('Nuovo preventivo');
    }

    // Aggiorna lo stato del cliente
    public function updateStatus($status)
    {
        $this->client->step = $status;
        $this->client->save();

        Flux::toast(
            text: "Stato aggiornato per  {$this->client->name}.",
            variant: 'success',
        );
    }

    public function sendEmails()
    {
        $this->emailForm->client_id = $this->client->id;
        $this->emailForm->store();

        $this->dispatch('refresh');

        Flux::toast(
            text: "Invio E-mail in corso.",
            variant: 'success',
        );

        Flux::modals()->close();
    }


    #[On('refresh')]
    public function render()
    {
        $estimates = Estimate::where('client_id', $this->client->id)->latest()->get();
        $histories = HistoryClient::where('client_id', $this->client->id)->latest()->get();
        $activities = Activity::where('client_id', $this->client->id)->latest()->get();
        $emails = Email::where('client_id', $this->client->id)->latest()->get();
        $notes = Note::where('client_id', $this->client->id)->latest()->get();
        $users = User::all();
        $clients = Client::all();

        $all = $users->concat($clients);

        $communications = collect();

        if ($this->communicationType === 'Attivita') {
            $communications = $activities;
        } elseif ($this->communicationType === 'E-mail') {
            $communications = $emails;
        } elseif ($this->communicationType === 'Nota') {
            $communications = $notes;
        } else {
            $communications = collect()
                ->merge($activities)
                ->merge($emails)
                ->merge($notes);
        }

        $communications = $communications
            ->sortByDesc(fn($record) => $record->created_at)
            ->values();

        return view('livewire.crm.client.show', [
            'estimates' => $estimates,
            'histories' => $histories,
            'activities' => $activities,
            'emails' => $emails,
            'notes' => $notes,
            'users' => $users,
            'all' => $all,
            'communications' => $communications,
            'referents' => Referent::where('client_id', $this->client->id)->when(
                $this->search,
                fn($q) => $q->where(
                    function ($query) {
                        $query->filter('name', $this->search)
                            ->orFilter('last_name', $this->search);
                    }
                )
            )->paginate(10),

            'email_all_users' => User::pluck('email')->toArray(),

        ]);
    }
}
