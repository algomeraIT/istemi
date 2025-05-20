<?php

namespace App\Livewire\Crm\Client\Partials;

use Flux\Flux;
use Carbon\Carbon;
use App\Models\Sale;
use App\Models\User;
use Livewire\Component;
use App\Models\Referent;
use App\Models\Acquisition;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Models\Communication;
use Livewire\WithFileUploads;
use App\Models\AccountingOrder;
use App\Models\AccountingInvoice;
use App\Livewire\Forms\ReferentForm;
class ClientTab extends Component
{
    use WithPagination, WithFileUploads;

    public ReferentForm $referentForm;

    public $client_id, $referent_id, $activity_id, $name, $last_name, $title, $job_position, $label, $to_do, $activities, $assignee, $expire_at, $email, $telephone, $role, $note, $task, $assigned_to, $sender, $attach_id;
    public $id_multiple_attaches, $user_id, $name_user, $last_name_user, $job_position_user, $status_user, $action, $receivers;
    public $receiver, $selectedEmails = [];

    public $isOpenReferent, $isOpenSale, $isOpenInvoice, $isOpenActivity, $isOpenEmail, $isOpenNote, $editing, $isSending, $has_multiple_attaches, $showModal,
        $showModalSale, $showModalInvoice, $showModalActivity, $showModalEmail, $showModalNote = false;

    public $selectedReferent, $selectedSale, $selectedInvoice, $selectedActivity, $selectedEmail, $selectedNote;
    public $activeTabAccounting = 'orders';
    public $activeTabSales = 'sales';
    public $logo;
    public $logoPreview;
    public string $query_referent = '';
    public string $query_orders = '';
    public string $query_invoices = '';
    public string $query_sales = '';
    public string $query_communications = '';
    public string $query_activities = '';
    public string $query_emails = '';
    public string $query_notes = '';
    public string $query_acquisitions = '';
    public string $status_sales = '';
    public string $status_orders = '';
    public string $status_invoices = '';
    public string $acquisition_sales = '';

    public $search;


    protected $rules = [
        'name' => 'required|string',
        'last_name' => 'required|string',
        'title' => 'nullable|string',
        'job_position' => 'nullable|string',
        'email' => 'required|email',
        'telephone' => 'nullable|string',
        'role' => 'nullable|string',
        'note' => 'nullable|string',
    ];

    public function mount($client)
    {
        $this->client_id = $client->id;
    }

    // Functions Referent
    public function setReferent($id = null, $action = 'create')
    {
        $this->referentForm->setReferent($id);

        if ($action == 'show') {
            Flux::modal('show-referent')->show();
        } else {
            Flux::modal('create-edit-referent')->show();
        }
    }

    public function createReferent()
    {
        $this->referentForm->client_id = $this->client_id;
        $this->referentForm->store();

        Flux::modals()->close();

        Flux::toast(
            text: "Nuovo referente inserito con successo.",
            variant: 'success',
        );

        $this->dispatch('refresh');
    }

    public function updateReferent()
    {
        $this->referentForm->update();

        Flux::modals()->close();

        Flux::toast(
            text: "Referent aggiornato con successo.",
            variant: 'success',
        );

        $this->dispatch('refresh');
    }

    public function showSale($id)
    {
        $this->selectedSale = Sale::findOrFail($id);
        $this->showModalSale = true;
    }
    public function showInvoice($id)
    {
        $this->selectedInvoice = AccountingInvoice::findOrFail($id);
        $this->showModalInvoice = true;
    }

    public function openModalReferent()
    {
        $this->resetFields();
        $this->isOpenReferent = true;
    }

    public function openModalActivity()
    {
        $this->resetFields();
        $this->isOpenActivity = true;
    }

    public function openModalEmail()
    {
        $this->resetFields();
        $this->isOpenEmail = true;
    }
    public function openModalNote()
    {
        $this->resetFields();
        $this->isOpenNote = true;
    }
    public function edit($id)
    {
        $referent = Referent::findOrFail($id);
        $this->referent_id = $referent->id;
        $this->name = $referent->name;
        $this->last_name = $referent->last_name;
        $this->title = $referent->title;
        $this->job_position = $referent->job_position;
        $this->email = $referent->email;
        $this->telephone = $referent->telephone;
        $this->role = $referent->role;
        $this->note = $referent->note;
        $this->editing = true;
        $this->isOpenReferent = true;
    }

    public function save()
    {
        $this->validate();

        Referent::updateOrCreate(
            ['id' => $this->referent_id],
            [
                'client_id' => $this->client_id,
                'name' => $this->name,
                'last_name' => $this->last_name,
                'title' => $this->title,
                'job_position' => $this->job_position,
                'email' => $this->email,
                'telephone' => $this->telephone,
                'role' => $this->role,
                'note' => $this->note,
            ]
        );

        session()->flash('message', $this->editing ? 'Referente aggiornato con successo!' : 'Referente creato con successo!');
        $this->closeModal();
    }

    public function saveActivity()
    {
        $validatedData = $this->validate([
            'client_id' => 'required|integer|exists:clients,id',
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'label' => 'nullable|string|max:255',
            'to_do' => 'required|in:to_do,done',
            'activities' => 'nullable|string',
            'assignee' => 'required|string|max:255',
            'expire_at' => 'nullable|date|after_or_equal:today',
        ]);

        session()->flash('message', $this->editing ? 'Attività aggiornata con successo!' : 'Attività creata con successo!');
        $this->closeModal();
    }

    public function attachments() {}

    public function attachmentsToEmail($user_id, $file) {}
    public function updatedLogo()
    {
        $this->validate([
            'logo' => 'file|mimes:pdf,doc,docx,xls,xlsx,jpeg,jpg,png|max:6144',
        ]);

        if (in_array($this->logo->getClientOriginalExtension(), ['jpeg', 'jpg', 'png'])) {
            $this->logoPreview = $this->logo->temporaryUrl();
        } else {
            $this->logoPreview = './images/default-logo.webp';
        }
    }
    public function removeLogo()
    {
        $this->logo = null;
        $this->logoPreview = null;
    }

    public function delete($id)
    {
        Referent::find($id)->delete();
        session()->flash('message', 'Referente eliminato con successo!');
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->showModalSale = false;
        $this->showModalInvoice = false;
        $this->showModalActivity = false;
        $this->showModalEmail = false;
        $this->showModalNote = false;
        $this->selectedReferent = null;
        $this->isOpenReferent = false;
        $this->isOpenActivity = false;
        $this->isOpenSale = false;
        $this->isOpenInvoice = false;
        $this->isOpenEmail = false;
        $this->isOpenNote = false;
        $this->resetFields();
    }

    private function resetFields()
    {
        $this->referent_id = null;
        $this->name = '';
        $this->last_name = '';
        $this->title = '';
        $this->job_position = '';
        $this->email = '';
        $this->telephone = '';
        $this->editing = false;
    }

    public function formatDate($date)
    {
        if (!$date) {
            return '';
        }

        $carbonDate = Carbon::parse($date);

        if ($carbonDate->isToday()) {
            return $carbonDate->diffForHumans();
        }

        if ($carbonDate->isYesterday()) {
            return 'Ieri';
        }

        return $carbonDate->translatedFormat('F j, Y');
    }

    #[On('refresh')]
    public function render()
    {
        return view('livewire.crm.client.partials.client-tab', [
            'referents' => Referent::where('client_id', $this->client_id)->when(
                $this->search,
                fn($q) => $q->where(
                    function ($query) {
                        $query->filter('name', $this->search)
                            ->orFilter('last_name', $this->search);
                    }
                )
            )->paginate(10),

            'sales' => Sale::where('client_id', $this->client_id)
                ->when($this->query_sales, fn($q) => $q->where('invoice', 'like', '%' . $this->query_sales . '%'))
                ->when($this->status_sales !== "", fn($q) => $q->where('status', $this->status_sales))
                ->paginate(10),

            'acquisitions' => Acquisition::where('client_id', $this->client_id)
                ->when($this->query_acquisitions, fn($q) => $q->where('invoice', 'like', '%' . $this->query_acquisitions . '%'))
                ->when($this->acquisition_sales !== "", fn($q) => $q->where('status', $this->acquisition_sales))
                ->paginate(10),

            'accounting_orders' => AccountingOrder::where('client_id', $this->client_id)
                ->when($this->query_orders, fn($q) => $q->where('order_number', 'like', '%' . $this->query_orders . '%'))
                ->when($this->status_orders !== "", fn($q) => $q->where('status', $this->status_orders))
                ->paginate(10),

            'accounting_invoices' => AccountingInvoice::where('client_id', $this->client_id)
                ->when($this->query_invoices, fn($q) => $q->where('number_invoice', 'like', '%' . $this->query_invoices . '%'))
                ->when($this->status_invoices !== "", fn($q) => $q->where('status', $this->status_invoices))
                ->paginate(10),
                
            'email_all_users' => User::pluck('email')->toArray(),
        ]);
    }
}
