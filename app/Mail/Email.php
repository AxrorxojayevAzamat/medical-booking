<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Email extends Mailable
{
   use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $name1;
    public $lastname1;
    public $email1;
    public $phone1;
    public $message1;

    public function __construct($name,$lastname,$email,$phone,$message)
    {

        $this->name1=$name;
        $this->lastname1=$lastname;
        $this->email1=$email;
        $this->phone1=$phone;
        $this->message1=$message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $name=$this->name1;
        $lastname=$this->lastname1;
        $email=$this->email1;
        $phone=$this->phone1;
        $message=$this->message1;
        
        return $this->view('emails.email',[
            'name'=>$name,
            'lastname'=>$lastname,
            'email'=>$email,
            'phone'=>$phone,
            'messages'=>$message
        ]);    
    }
}
