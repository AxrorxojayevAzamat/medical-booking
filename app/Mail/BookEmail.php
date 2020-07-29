<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookEmail extends Mailable
{

    use Queueable,
        SerializesModels;

    public $date;
    public $time;
    public $doctor;
    public $clinic;
    public $price;
    public $currency;

    public function __construct($date, $time, $doctor, $clinic, $price, $currency)
    {
        $this->date = $date;
        $this->time = $time;
        $this->doctor = $doctor;
        $this->clinic = $clinic;
        $this->price = $price;
        $this->currency = $currency;
    }

    public function build()
    {
        return $this->view('emails.book', [
                    'date' => $this->date,
                    'time' => $this->time,
                    'doctor' => $this->doctor,
                    'clinic' => $this->clinic,
                    'price' => $this->price,
                    'currency' => $this->currency
        ]);
    }

}
