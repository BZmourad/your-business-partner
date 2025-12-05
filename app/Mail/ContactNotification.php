<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $contactData;

    public function __construct($contactData){
        $this->contactData = $contactData;
    }

    public function build(){
        $appName = env('APP_NAME', 'Application');
        return $this->markdown('emails.contact-notification')->subject($this->subject)->with([
            'contact' => $this->contactData,
            'appName' => $appName
        ]);
    }
}