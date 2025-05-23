<?php

namespace App\Livewire\Crm\Client;

use Flux\Flux;
use Livewire\Component;
use Livewire\Attributes\On;

// Models
use App\Models\Note;
use App\Models\User;
use App\Models\Email;
use App\Models\Client;
use App\Models\Activity;
use App\Models\Referent;
use App\Models\HistoryClient;

// Forms
use App\Livewire\Forms\Client\ReferentForm;
use App\Livewire\Forms\Client\ActivityForm;
use App\Livewire\Forms\Client\EmailForm;
use App\Livewire\Forms\Client\NoteForm;
use App\Livewire\Forms\client\CallForm;

// Traits
use App\Livewire\Crm\Client\Traits\ActivityActions;
use App\Livewire\Crm\Client\Traits\CallActions;
use App\Livewire\Crm\Client\Traits\ReferentActions;
use App\Livewire\Crm\Client\Traits\MailActions;
use App\Livewire\Crm\Client\Traits\NoteActions;
use App\Models\Call;

class Show extends Component
{
    use ReferentActions;
    public ReferentForm $referentForm;

    use ActivityActions;
    public ActivityForm $activityForm;

    use MailActions;
    public EmailForm $emailForm;

    use NoteActions;
    public NoteForm $noteForm;

    use CallActions;
    public CallForm $callForm;

    public $client;
    public $references;
    public $communicationType;

    public $tabs = [];
    public $search;

    public function mount($id)
    {
        $this->client = Client::with('user', 'referents', 'activities', 'emails', 'notes')->findOrFail($id);
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
            text: "Stato aggiornato per {$this->client->name}.",
            variant: 'success',
        );
    }

    #[On('refresh')]
    public function render()
    {
        $histories = HistoryClient::where('client_id', $this->client->id)->latest()->get();
        $referents = Referent::where('client_id', $this->client->id);
        $activities = Activity::where('client_id', $this->client->id)->latest()->get();
        $emails = Email::where('client_id', $this->client->id)->latest()->get();
        $notes = Note::where('client_id', $this->client->id)->latest()->get();
        $calls = Call::where('client_id', $this->client->id)->latest()->get();
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
        } elseif ($this->communicationType === 'Chiamata') {
            $communications = $calls;
        } else {
            $communications = collect()
                ->merge($activities)
                ->merge($emails)
                ->merge($notes)
                ->merge($calls);
        }

        $communications = $communications
            ->sortByDesc(fn($record) => $record->created_at)
            ->values();

        if ($this->search) {
            $referents->where(
                function ($query) {
                    $query->filter('name', $this->search)
                        ->orFilter('last_name', $this->search);
                }
            );
        }

        return view('livewire.crm.client.show', [
            'histories' => $histories,
            'activities' => $activities,
            'emails' => $emails,
            'notes' => $notes,
            'calls' => $calls,
            'users' => $users,
            'all' => $all,
            'communications' => $communications,
            'referents' => $referents->paginate(10),
            'email_all_users' => User::pluck('email')->toArray(),
        ]);
    }
}
