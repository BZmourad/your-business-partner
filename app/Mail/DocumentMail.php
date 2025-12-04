<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Document\Document;

class DocumentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $content;
    public $document;
    public $attachments;

    public function __construct($subject, $content, Document $document, $attachments = [])
    {
        $this->subject = $subject;
        $this->content = $content;
        $this->document = $document;
        $this->attachments = $attachments;
    }

    public function build()
    {
        $email = $this->markdown('emails.request-document')->subject($this->subject)->with([
            'content' => $this->content,
            'document' => $this->document,
            'request' => $this->document->request,
            'customer' => $this->document->request->customer
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