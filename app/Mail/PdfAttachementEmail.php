<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use App\Models\User;
use Illuminate\Queue\SerializesModels;

class PdfAttachementEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
  

    public $user;
    public $destinationPath;

    public function __construct(User $user, $destinationPath)
    {
        $this->user = $user;
        $this->destinationPath = $destinationPath;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        return $this
        ->from('olumide.okuntade@gmail.com')
        ->subject('Email Verification')
        ->attach($this->destinationPath)
        ->view('emails.user_account_created',[
            'user'=> $this->user
        ]);
    }
}
