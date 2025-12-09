<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BulkNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $message;

    /**
     * Create a new message instance.
     */
    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public function build()
    {
        return $this->subject('Pemberitahuan system')
            ->view('emails.bulk-notification', [
                'message' => $this->message
            ]);
    }
}
