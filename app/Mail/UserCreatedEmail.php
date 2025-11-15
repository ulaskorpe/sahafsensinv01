<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserCreatedEmail extends Mailable
{
    use Queueable, SerializesModels;

        private $name;
        private $link; 
        private $code; 
   

    /**
     * Create a new message instance.
     */
    public function __construct($name,$link,$code)
    {
        $this->name = $name;
        $this->link =$link;
        $this->code =$code;
       
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'SahafSensin\'e hoşgeldiniz',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.user_created',
            with :[
                'name'=> $this->name,
                'link'=>$this->link,
                'code'=>$this->code,
                
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
