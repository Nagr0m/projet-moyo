<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $datas;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $datas)
    {
        $this->datas = $datas;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->replyTo($this->datas['email'])
                    ->view('mails.contact');
    }
}
