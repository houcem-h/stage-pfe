<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class edit_email extends Mailable
{
    use Queueable, SerializesModels;

    public $Datemail;

    public function __construct($date)
    {
        $this->Datemail = $date;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails/students/change_email')->with("date",$this->Datemail);
    }
}
