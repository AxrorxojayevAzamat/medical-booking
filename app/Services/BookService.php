<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Entity\Region;
use App\Entity\Clinic\Clinic;
use App\Entity\Book\Book;
use App\Entity\User\User;
use App\Entity\Clinic\Timetable;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookEmail;



class BookService
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
        $text = 'Ваше бронирование: Дата: ' . $book->booking_date . ', Начало времени: ' . $book->time_start . ', Конец времени: ' . $book->time_finish . ', Имя доктора: ' . $doctor->profile->fullName . ', Название клиники: ' . $clinic->name . ', Стоимость бронирования ' . $this->price . ' ' . $this->currency . (empty($link) ? '' : ('Для активации бронирования оплатите по этой ссылке ' . $link));

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
                        $book->time_finish,
                        $doctor->profile->fullName,
                        $clinic->name,
                        $this->price,
                        $this->currency,
                        $link
                )
        );
    }

    public function getTimeFinish($doctorId, $clinicId, $timeStart)
    {
        $timetable = Timetable::where('doctor_id', $doctorId)->where('clinic_id', $clinicId)->first();
        $timeFinish = Carbon::parse($timeStart);
        $timeFinish->addMinutes($timetable->interval);
        
        return $timeFinish->format('H:i');
    }

    public function findDoctorByRegion(Request $request)
    {
        $region_id = $request->get('region');
        $result = $this->findCityByRegion($region_id);
        $clinics = $this->findClinicByRegion($region_id);

        $data = ['cities' => $result, 'clinics' => $clinics];


        return json_encode($data);
    }

    public function findDoctorByType(Request $request)
    {
        $region_id = $request->get('region');
        $city_id = $request->get('city');
        $type_id = $request->get('type');

        $result = $this->findClinicByType($type_id, $city_id, $region_id);

        return json_encode($result);
    }

    public function findCityByRegion($region_id)
    {
        if (!empty($region_id)) {
            $result = Region::where('parent_id', $region_id)->pluck('name_ru', 'id');
        }

        if (empty($region_id)) {
            $result = Region::whereNotNull('parent_id')->pluck('name_ru', 'id');
        }

        return $result;
    }

    public function findClinicByType($type_id, $city_id, $region_id)
    {
        $query = Clinic::orderBy('id');

        if (!empty($region_id)) {
            $regionList = Region::where('parent_id', $region_id)->pluck('id')->toArray();
            $query->whereIn('region_id', $regionList);
        }
        if (!empty($region_id) && empty($city_id)) {
            $regionList = Region::where('parent_id', $region_id)->pluck('id')->toArray();
            $query->whereIn('region_id', $regionList);
        }

        if (!empty($city_id)) {
            $query->where('region_id', $city_id);
        }

        if (!empty($type_id)) {
            $query->where('type', $type_id);
        }

        $result = $query->pluck('name_ru', 'id');

        return $result;
    }

    public function findClinicByRegion($region_id)
    {
        $query = Clinic::orderBy('id');

        if (!empty($region_id)) {
            $regionList = Region::where('parent_id', $region_id)->pluck('id')->toArray();
            $query->whereIn('region_id', $regionList);
        }

        $result = $query->pluck('name_ru', 'id');

        return $result;
    }

    public function daysDisabled(array $dayOfWeeks, string $start, string $end)
    {
        $daysOff1 = array();
        $period = CarbonPeriod::between($start, $end);

        foreach ($period as $date) {
            if (!empty($dayOfWeeks)) {
                foreach ($dayOfWeeks as $dayOfWeek) {
                    if ($date->dayOfWeek === $dayOfWeek) {
                        $daysOff1[] = $date->format('Y-m-d');
                    }
                }
            }
        }
        return $daysOff1;
    }

    public function daysDisabledBool(bool $isOdd, string $start, string $end)
    {
        $daysOff1 = array();
        $period = CarbonPeriod::between($start, $end);

        foreach ($period as $date) {
            if ($date->day % 2 == $isOdd) {
                $daysOff1[] = $date->format('Y-m-d');
            }
        }
        return $daysOff1;
    }

    public function restDays(string $restStart, string $restEnd)
    {
        $daysOff3 = array();
        $restPeriod = CarbonPeriod::between($restStart, $restEnd);
        if (!empty($restPeriod)) {
            foreach ($restPeriod as $date) {
                $daysOff3[] = $date->format('Y-m-d');
            }
        }
        return $daysOff3;
    }

    public function celebrationDays(Collection $celebrationDays)
    {
        $daysOff2 = array();
        if (!empty($celebrationDays)) {
            foreach ($celebrationDays as $celeb) {
                $count = $celeb->quantity;
                $c = Carbon::createFromFormat('Y-m-d H:i:s', $celeb->date);
                for ($i = 0; $i < $count; $i++) {
                    $daysOff2[] = $c->format('Y-m-d');
                    $c = $c->addDay();
                }
            }
        }
        return $daysOff2;
    }

    public function timeSlots(Timetable $timetable, string $currentDate)
    {
        $timeSlots = array();
        $duration = $this->getTime($timetable, $currentDate);
        if (!empty($duration['start']) && !empty($duration['end']) && !empty($duration['inter'])) {
            $timeSlots = $this->getTimes($duration['start'], $duration['end'], $duration['inter']);
        }
        return $timeSlots;
    }

    public function getTimes(string $startTime, string $endTime, int $interval)
    {
        $time_slots = array();
        if (!empty($startTime) && !empty($endTime) && !empty($interval)) {
            $start_time = Carbon::createFromFormat('H:i:s', $startTime);
            $end_time = Carbon::createFromFormat('H:i:s', $endTime);

            $time = $start_time;

            while ($end_time->greaterThan($time)) {
                $time_slots[] = $time->format('H:i');
                $time = $time->addMinutes($interval);
            }
        }

        return $time_slots;
    }

    public
            function getTime(Timetable $timetable, string $date)
    {
        $carbon = Carbon::createFromFormat('Y-m-d', $date);
        $time = array();
        if ($timetable->isWeek()) {
            switch ($carbon->dayOfWeek) {
                case Carbon::MONDAY:
                    $time['start'] = $timetable->monday_start;
                    $time['end'] = $timetable->monday_end;
                    $time['inter'] = $timetable->interval;
                    break;
                case Carbon::TUESDAY:
                    $time['start'] = $timetable->tuesday_start;
                    $time['end'] = $timetable->tuesday_end;
                    $time['inter'] = $timetable->interval;
                    break;
                case Carbon::WEDNESDAY:
                    $time['start'] = $timetable->wednesday_start;
                    $time['end'] = $timetable->wednesday_end;
                    $time['inter'] = $timetable->interval;
                    break;
                case Carbon::THURSDAY:
                    $time['start'] = $timetable->thursday_start;
                    $time['end'] = $timetable->thursday_end;
                    $time['inter'] = $timetable->interval;
                    break;
                case Carbon::FRIDAY:
                    $time['start'] = $timetable->friday_start;
                    $time['end'] = $timetable->friday_end;
                    $time['inter'] = $timetable->interval;
                    break;
                case Carbon::SATURDAY:
                    $time['start'] = $timetable->saturday_start;
                    $time['end'] = $timetable->saturday_end;
                    $time['inter'] = $timetable->interval;
                    break;
                case Carbon::SUNDAY:
                    $time['start'] = $timetable->sunday_start;
                    $time['end'] = $timetable->sunday_end;
                    $time['inter'] = $timetable->interval;
                    break;
            }
        }
        if ($timetable->isOdd()) {
            $time['start'] = $timetable->odd_start;
            $time['end'] = $timetable->odd_end;
            $time['inter'] = $timetable->interval;
        }

        if ($timetable->isEven()) {
            $time['start'] = $timetable->even_start;
            $time['end'] = $timetable->even_end;
            $time['inter'] = $timetable->interval;
        }

        return $time;
    }

    public function getDaysConst(Timetable $timetable)
    {

        $daysConst = array();
        if ($timetable->isWeek()) {
            if (empty($timetable->monday_start)) {
                array_push($daysConst, Carbon::MONDAY);
            }

            if (empty($timetable->tuesday_start)) {
                array_push($daysConst, Carbon::TUESDAY);
            }

            if (empty($timetable->wednesday_start)) {
                array_push($daysConst, Carbon::WEDNESDAY);
            }

            if (empty($timetable->thursday_start)) {
                array_push($daysConst, Carbon::THURSDAY);
            }

            if (empty($timetable->friday_start)) {
                array_push($daysConst, Carbon::FRIDAY);
            }

            if (empty($timetable->saturday_start)) {
                array_push($daysConst, Carbon::SATURDAY);
            }

            if (empty($timetable->sunday_start)) {
                array_push($daysConst, Carbon::SUNDAY);
            }
        }

        return $daysConst;
    }

}
