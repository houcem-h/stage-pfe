<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TeacherRef extends Mailable
{
    use Queueable, SerializesModels;


    public $user;
    public $int;
    public $student;


        /**
         * Create a new message instance.
         *
         * @return void
         */
        public function __construct(User $user,  Internship $int, User $student)
        {
            $this->user=$user;
            $this->int=$int;
            $this->student=$student;




        }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.Refmail');
    }
}
