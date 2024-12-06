<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendInvitation extends Mailable
{
    use Queueable, SerializesModels;

    public $event;
    public $email;

    public function __construct($event, $email)
    {
        $this->event = $event;
        $this->email = $email;
    }

    public function build()
    {
        return $this->subject('Event Invitation: ' . $this->event->name)
            ->view('emails.invitation')
            ->with([
                'eventName' => $this->event->name,
                'eventDescription' => $this->event->description,
                'eventDate' => $this->event->date,
                'eventLocation' => $this->event->location,
                'recipientEmail' => $this->email,
            ]);
    }
}