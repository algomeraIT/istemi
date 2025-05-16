<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class HistoryContactForm extends Form
{
    
    public $user_id, $client_id, $estimate_id, $type, $note, $action;

    public $recipients = [];
}
