<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    public $password;

    /**
     * Create a new message instance.
     */
    public function __construct($password)
    {
        $this->password = $password;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Nuova Password per Istemi')
                    ->view('email.password_reset')
                    ->with(['password' => $this->password]);
    }
}
