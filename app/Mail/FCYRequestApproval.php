<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FCYRequestApproval extends Mailable
{
    use Queueable, SerializesModels;

    public $fcyRequest;

    public function __construct($fcyRequest)
    {
        $this->fcyRequest = $fcyRequest;
    }

    public function build()
    {
        return $this->subject('FCY Request Registration - Appproved')
            ->view('emails.fcyRequestAuth');
    }
}
