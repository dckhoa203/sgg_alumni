<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmail extends Mailable
{
    public $subject;
    public $message;
    public $datetime;
    public $file;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($s,$m,$d,$f)
    {
        $this->subject = $s;
        $this->message = $m;
        $this->datetime = $d;
        $this->file    = $f;
    }

    /** 
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $e_subject = $this->subject;
        $e_message = $this->message;
        $e_date_time = $this->datetime;
        $e_file = $this->file;

        return $this->view('pages.admins.mails.mail',compact("e_message"))
        ->subject($e_subject)
        ->with('datetime',$e_date_time)
        ->attachData($this->file,$e_file, [
            'mime' => 'application/pdf',
        ]);
    }
}
