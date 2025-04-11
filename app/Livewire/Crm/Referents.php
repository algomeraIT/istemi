<?php

namespace App\Livewire\Crm;

use App\Models\AccountingInvoice;
use App\Models\AccountingOrder;
use App\Models\Acquisition;
use App\Models\ActivityCommunicationClientHistory;
use App\Models\Communication;
use App\Models\EmailCommunicationClientHistory;
use App\Models\NoteCommunicationClientHistory;
use App\Models\Referent;
use App\Models\Sale;
use App\Models\Users;
use Auth;
use Carbon\Carbon;
use DB;
use Exception;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Referents extends Component
{
    use WithPagination, WithFileUploads;

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

    public function show($id)
    {
        $this->selectedReferent = Referent::findOrFail($id);
        $this->showModal = true;
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

    public function showActivity($id)
    {
        $this->selectedActivity = ActivityCommunicationClientHistory::findOrFail($id);
        $this->showModalActivity = true;
    }

    public function showEmail($id)
    {
        $this->selectedEmail = EmailCommunicationClientHistory::findOrFail($id);
        $this->showModalEmail = true;
    }

    public function showNote($id)
    {
        $this->selectedNote = NoteCommunicationClientHistory::findOrFail($id);
        $this->showModalNote = true;
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

        ActivityCommunicationClientHistory::updateOrCreate(
            ['id' => $this->activity_id],
            $validatedData
        );

        session()->flash('message', $this->editing ? 'Attività aggiornata con successo!' : 'Attività creata con successo!');
        $this->closeModal();
    }

    public function attachments()
    {

    }

    public function attachmentsToEmail($user_id, $file)
    {

    }
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
    public function saveEmail()
    {
        try {
            DB::beginTransaction();
            $this->isSending = true;

            $validatedData = $this->validate([
                'client_id' => 'required|exists:clients,id',
                'task' => 'nullable|string|max:255',
                'assigned_to' => 'nullable|string|max:255',
                'receiver' => 'required|array',
                'receiver.*' => 'required|email',
                'action' => 'required|string|max:255',
                'note' => 'nullable|string',
                'logo' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpeg,jpg,png|max:6144', //6MB
                'logo.max' => 'La dimensione del file supera i 6MB.',
                'logo.mimes' => 'Solo PDF, DOC, DOCX, XLS, JPEG, JPG, PNG file sono permessi.',

            ]);

            $validatedData['sender'] = Auth::user()->email;
            $validatedData['user_id'] = Auth::user()->id;
            $validatedData['name_user'] = Auth::user()->name;
            $validatedData['last_name_user'] = Auth::user()->last_name;
            $validatedData['job_position_user'] = Auth::user()->job_position;
            $validatedData['status_user'] = Auth::user()->status;
            $validatedData['receiver'] = implode(',', $validatedData['receiver']);

            $emailRecord = EmailCommunicationClientHistory::create($validatedData);

            if ($this->logo) {
                $emailRecord->clearMediaCollection('emailCommunicationFile');
                $emailRecord->addMedia($this->logo)
                    ->toMediaCollection('emailCommunicationFile');

                $getFilePath[] = $emailRecord->getFirstMediaUrl('emailCommunicationFile');
                $emailRecord->path = $getFilePath;
                $emailRecord->save();
            }

            $receivers = explode(',', $emailRecord->receiver);

            if (empty($receivers)) {
                throw new Exception('Per il destinatario non è stato fornito un indirizzo email corretto...');
            }

            // Send the email
            Mail::send('email.email-communication', ['emailRecord' => $emailRecord], function ($message) use ($emailRecord, $receivers) {
                $fromEmail = Auth::user()->email;
                if (!$fromEmail) {
                    throw new Exception("L'email del mittente non è stata trovata...");
                }

                $message->from($fromEmail, env('MAIL_FROM_NAME'));

                if (count($receivers) > 0) {
                    $message->to($receivers);
                } else {
                    throw new Exception('Email del destinatario, o dei destinatari, non valide');
                }

                $message->subject($emailRecord->action);

                if ($emailRecord->getFirstMediaUrl('emailCommunicationFile')) {
                    $message->attach($emailRecord->getFirstMediaUrl('emailCommunicationFile'));
                }

            });
            $this->isSending = false;

            DB::commit();

            session()->flash('message', 'Email inviata con successo.');

            $this->closeModal();

        } catch (Exception $e) {
            DB::rollBack();
            $this->isSending = false;
            $this->closeModal();
            dd($e);
            session()->flash('error', 'Si è verificato un errore durante l\'invio dell\'email. Riprova più tardi...');
        }
    }

    public function saveNote()
    {
        try {
            DB::beginTransaction();

            $validatedData = $this->validate([
                'client_id' => 'required|integer|exists:clients,id',
                'note' => 'nullable|string',
                'logo' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpeg,jpg,png|max:6144', // 6MB
            ]);

            $validatedData['user_id'] = Auth::user()->id;
            $validatedData['name_user'] = Auth::user()->name;
            $validatedData['last_name_user'] = Auth::user()->last_name;
            $validatedData['role_user'] = Auth::user()->role;

            $noteRecord = NoteCommunicationClientHistory::updateOrCreate(
                ['id' => $this->activity_id],
                $validatedData
            );

            if ($this->logo) {
                $noteRecord->clearMediaCollection('noteCommunicationFile');

                $noteRecord->addMedia($this->logo)
                    ->toMediaCollection('noteCommunicationFile');

                $getFilePath[] = $noteRecord->getFirstMediaUrl('noteCommunicationFile');
                $noteRecord->path = json_encode($getFilePath);
                $noteRecord->save();
            }

            DB::commit();

            session()->flash('message', $this->editing ? 'Nota aggiornata con successo!' : 'Nota creata con successo!');
            $this->closeModal();
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaction on error
            dd($e);
            session()->flash('error', 'Si è verificato un errore durante il salvataggio. Riprova più tardi.');
        }
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

    public function render()
    {
        return view('livewire.crm.referents', [
            'referents' => Referent::where('client_id', $this->client_id)
                ->when($this->query_referent, fn($q) =>
                    $q->where(function ($query) {
                        $query->where('name', 'like', '%' . $this->query_referent . '%')
                            ->orWhere('last_name', 'like', '%' . $this->query_referent . '%');
                    })
                )
                ->paginate(10),

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

            'communications' => Communication::where('client_id', $this->client_id)
                ->when($this->query_communications, fn($q) => $q->where('message', 'like', '%' . $this->query_communications . '%'))
                ->paginate(10),

            'activity_communications' => ActivityCommunicationClientHistory::where('client_id', $this->client_id)
                ->when($this->query_activities, fn($q) => $q->where('activities', 'like', '%' . $this->query_activities . '%'))
                //->orderBy('created_at', 'desc')
                ->paginate(10),
            'email_communications' => EmailCommunicationClientHistory::where('client_id', $this->client_id)
                ->when($this->query_emails, fn($q) => $q->where('sender', 'like', '%' . $this->query_emails . '%'))
                ->orderBy('created_at', 'desc')->paginate(10),

            'note_communications' => NoteCommunicationClientHistory::where('client_id', $this->client_id)
                ->when($this->query_notes, fn($q) => $q->where('note', 'like', '%' . $this->query_notes . '%'))
                ->orderBy('created_at', 'desc')->paginate(10),

            'email_all_users' => Users::pluck('email')->toArray(),
        ]);
    }
}
