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
    public $start_time;
    public $finish_time;
    public $doctor;
    public $clinic;
    public $price;
    public $currency;
    public $link;

    public function __construct($date, $start_time, $finish_time, $doctor, $clinic, $price, $currency,$link)
    {
        $this->date = $date;
        $this->start_time = $start_time;
        $this->finish_time = $finish_time;
        $this->doctor = $doctor;
        $this->clinic = $clinic;
        $this->price = $price;
        $this->currency = $currency;
        $this->link = $link;
    }

    public function build()
    {
        return $this->view('emails.book', [
                    'date' => $this->date,
                    'start_time' => $this->start_time,
                    'finish_time' => $this->finish_time,
                    'doctor' => $this->doctor,
                    'clinic' => $this->clinic,
                    'price' => $this->price,
                    'currency' => $this->currency,
                    'link' => $this->link
        ]);
    }

}
