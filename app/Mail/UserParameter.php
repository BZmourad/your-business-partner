<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserParameter extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $plainPassword;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$plainPassword)
    {
        $this->user = $user;
        $this->plainPassword = $plainPassword;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.auth',['user'=>$this->user,'plainPassword'=>$this->plainPassword])->subject(__("Paramétres d'access"));
    }
}