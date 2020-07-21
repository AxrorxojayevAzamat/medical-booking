<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Email extends Mailable
{
   use Queueable, SerializesModels;

    public $name;
    public $lastname;
    public $email;
    public $phone;
    public $message;

    public function __construct($name,$lastname,$email,$phone,$message)
    {
        $this->name=$name;
        $this->lastname=$lastname;
        $this->email=$email;
        $this->phone=$phone;
        $this->message=$message;
    }

    public function build()
    {
        return $this->view('emails.email',[
            'name'=>$this->name,
            'lastname'=>$this->lastname,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'messages'=>$this->message
        ]);    
    }
}
