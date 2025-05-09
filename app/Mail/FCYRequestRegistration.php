<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FCYRequestRegistration extends Mailable
{
    use Queueable, SerializesModels;

    public $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function build()
    {
        return $this->subject('New FCY Request Registered')
            ->view('emails.fcyRequestRegister');
    }
}
