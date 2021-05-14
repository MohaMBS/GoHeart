<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    public $subject;
    public $ref;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    // ('wqdqwd','qwdwqdqw')
    public function __construct($details,$subject,$ref)
    {
        $this->details = $details;
        $this->subject = $subject;
        $this->ref = $ref;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.myTestMail');
    }
}
