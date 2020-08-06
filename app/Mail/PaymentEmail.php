<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentEmail extends Mailable
{

    use Queueable,
        SerializesModels;

    public $title;
    public $context;
    public $footer;
    public $link;

    public function __construct($title, $context, $footer, $link)
    {
        $this->title = $title;
        $this->context = $context;
        $this->footer = $footer;
        $this->link = $link;
    }

    public function build()
    {
        return $this->view('emails.payment', [
                    'title' => $this->title,
                    'context' => $this->context,
                    'footer' => $this->footer,
                    'link' => $this->link
        ]);
    }

}
