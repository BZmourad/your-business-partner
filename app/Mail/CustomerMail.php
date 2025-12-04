<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomerMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $content;
    public $attachments;

    public function __construct($subject, $content, $attachments = []){
        $this->subject = $subject;
        $this->content = $content;
        $this->attachments = $attachments;
    }

    public function build(){
        $email = $this->markdown('emails.customer')->subject($this->subject)->with([
            'content' => $this->content
        ]);
        foreach ($this->attachments as $attachment) {
            $email->attach(
                $attachment['file'], 
                $attachment['options']
            );
        }
        return $email;
    }
}