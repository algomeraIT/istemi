<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;
use App\Models\Client;

class SendClientMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $subjectLine;
    protected $bodyContent;
    protected $recipientClient;
    protected $ccList;
    protected $files = [];

    /**
     * Create a new message instance.
     */
    public function __construct($subject, $body, $recipient, $cc, array $attachments = [])
    {
        $this->subjectLine = $subject;
        $this->bodyContent = $body;
        $this->recipientClient = $recipient;
        $this->ccList = $cc;
        $this->files = $attachments;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            to: [$this->recipientClient->email],
            cc: $this->ccList,
            subject: $this->subjectLine,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.client',
            with: [
                'body' => $this->bodyContent,
                'recipient' => $this->recipientClient,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return collect($this->files)
            ->map(function ($file) {
                return Attachment::fromPath($file->getRealPath())
                    ->as($file->getClientOriginalName());
            })
            ->all();
    }
}
