<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPassword extends Mailable
{
    use Queueable, SerializesModels;
    public $password;
    public $username;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($p,$u)
    {
        $this->password = $p;
        $this->username = $u;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $send_pass = $this->password;
        $send_username = $this->username;
        return $this->view('pages.admins.mails.send_password')
        ->with('send_pass',$send_pass)
        ->with('send_username',$send_username);
    }
}
