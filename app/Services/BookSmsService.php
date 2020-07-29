<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use App\Mail\BookEmail;
use App\Entity\User\User;
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

    public function toSms($userId, $doctorId, $clinicId, $bookingDate, $timeStart)
    {
        $patient = User::find($userId);
        $doctor = User::find($doctorId);
        $clinic = Clinic::find($clinicId);

//        'Ваше бронирование: Дата: 2020-07-31, Время: 14:00, Имя доктора: Haag Joelle, Название клиники: Favian Durgan, Стоимость бронирования 1200 UZS';
        $text = 'Ваше бронирование: Дата: ' . $bookingDate . ', Время: ' . $timeStart . ', Имя доктора: ' . $doctor->profile->fullName . ', Название клиники: ' . $clinic->name . ', Стоимость бронирования ' . $this->price . ' ' . $this->currency;

        $state = false;
        $from = "6100";
        $url_array = array(
            'username' => 'wifi_auth',
            'password' => 'wifi_farruh',
            'smsc' => 'smsc1',
            'from' => $from,
            'to' => $patient->phone,
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

    public function toMail($userId, $doctorId, $clinicId, $bookingDate, $timeStart)
    {
        $patient = User::find($userId);
        $doctor = User::find($doctorId);
        $clinic = Clinic::find($clinicId);

        Mail::to($patient->email)->send(
                new BookEmail(
                        $bookingDate,
                        $timeStart,
                        $doctor->profile->fullName,
                        $clinic->name,
                        $this->price,
                        $this->currency
                )
        );
    }

}
