<?php

namespace App\Mail;

use App\Models\EmailTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    protected $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

//    public function build()
//    {
//        return $this->from('support@yteviec.com', 'Y Te Viec')
//                    ->subject('Send Mail')
//                    ->view('emails.demo');
//    }

    public function build()
    {
        \App::setLocale($this->data['locale']);
        if(isset($this->data['attachments'])){
            $this->from('support@yteviec.com','Y Te Viec')
                ->view($this->data['view_file'])
                ->subject($this->data['subject'])
                ->with($this->data)
                ->attach($this->data['attachments']);
        }
        else {
            $this->from('support@yteviec.com','Y Te Viec')
                 ->view($this->data['view_file'])
                ->subject($this->data['subject'])
                ->with($this->data);
        }
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
