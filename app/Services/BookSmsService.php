<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use App\Mail\BookEmail;
use App\Entity\User\User;
use App\Entity\Book\Book;
use App\Entity\Clinic\Clinic;

class BookSmsService
{

    private $price;
    private $currency;

    public function __construct()
    {
        $this->price = config('book.booking_price');
        $this->currency = config('book.default_currency');
    }

    public function toSms($book_id, $link)
    {
        $book = Book::findOrFail($book_id);

        $patient = User::findOrFail($book->user_id);
        $doctor = User::findOrFail($book->doctor_id);
        $clinic = Clinic::findOrFail($book->clinic_id);

//        'Ваше бронирование: Дата: 2020-07-31, Время: 14:00, Имя доктора: Haag Joelle, Название клиники: Favian Durgan, Стоимость бронирования 1200 UZS';
        $text = 'Ваше бронирование: Дата: ' . $book->booking_date . ', Время: ' . $book->time_start . ', Имя доктора: ' . $doctor->profile->fullName . ', Название клиники: ' . $clinic->name . ', Стоимость бронирования ' . $this->price . ' ' . $this->currency . (empty($link) ? '' : ('Для активации бронирования оплатите по этой ссылке ' . $link));

        $state = false;
        $from = "6100";
        $to = '998' . $patient->phone;
        $url_array = array(
            'username' => 'wifi_auth',
            'password' => 'wifi_farruh',
            'smsc' => 'smsc1',
            'from' => $from,
            'to' => $to,
            'charset' => 'utf-8',
            'coding' => 2,
            'text' => $text
        );
        $url = 'http://185.74.5.117:13002/cgi-bin/sendsms?' . http_build_query($url_array);
        $output = "";
        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        if (!curl_errno($handle)) {
            $state = true;
            $output = curl_exec($handle);
            curl_close($handle);
        }

        $res = response()->json([
            'success' => $state,
            'output' => $output,
//          'url' => null,
        ]);
        return $res;
    }

    public function toMail($book_id, $link)
    {
        $book = Book::findOrFail($book_id);

        $patient = User::findOrFail($book->user_id);
        $doctor = User::findOrFail($book->doctor_id);
        $clinic = Clinic::findOrFail($book->clinic_id);

        Mail::to($patient->email)->send(
                new BookEmail(
                        $book->booking_date,
                        $book->time_start,
                        $doctor->profile->fullName,
                        $clinic->name,
                        $this->price,
                        $this->currency,
                        $link
                )
        );
    }

}
