<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPass extends Mailable
{
    use Queueable, SerializesModels;
    public $userID;
    public $email;
    public $token_pass;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id,$e,$tp)
    {
        $this->userID = $id;
        $this->email = $e;
        $this->token_pass = $tp;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $send_userID = $this->userID;
        $send_email = $this->email;
        $token_password = $this->token_pass;
        return $this->view('pages.admins.forget_password.send_email')
        ->with('userID',$send_userID)
        ->with('email',$send_email)
        ->with('token_password',$token_password);
    }
}
