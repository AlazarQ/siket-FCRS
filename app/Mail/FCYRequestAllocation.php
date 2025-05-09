<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FCYRequestAllocation extends Mailable
{
    use Queueable, SerializesModels;

    public $fcyRequest;

    public function __construct($fcyRequest)
    {
        $this->fcyRequest = $fcyRequest;
    }

    public function build()
    {
        return $this->subject('FCY Request Allocation - Appproved')
            ->view('emails.fcyRequestAllocation');
    }
}
