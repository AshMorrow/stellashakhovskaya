<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMassage extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $from_adr;
    public $name;
    public $phone;
    public $msg;

    public function __construct($from ='', $name = '', $phone = '', $msg = '')
    {
        $this->from_adr = $from;
        $this->name = $name;
        $this->phone = $phone;
        $this->msg = $msg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Сообщение от '.$this->name .'    '. date('Y-m-d (H : i)',time()))->from('info@stellashakhovskaya.ua')->view('emails.msg',compact($this->from_adr,$this->name,$this->phone,$this->msg));
    }
}
