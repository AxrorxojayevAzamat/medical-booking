<?php

namespace App\Http\Controllers\Admin\CallCenter;

use App\Entity\Clinic\Timetable;
use App\Http\Controllers\Controller;
use App\Entity\User\User;
use App\Entity\Region;
use App\Entity\Clinic\Clinic;
use App\Entity\Clinic\Specialization;
use App\Entity\Book\Book;
use App\Entity\Celebration;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class CallCenterController extends Controller {

    public function index(Request $request) {

        $region_id = $request->get('region');
        $city_id = $request->get('city');
        $type_id = $request->get('type');

        $query = Clinic::with(['doctors', 'doctors.specializations']);


        $regionList = Region::where('parent_id', null)->pluck('name_ru', 'id');
        $cityList = $this->findCityByRegion($region_id);

        $clinicTypeList = Clinic::clinicTypeList();
        $specList = Specialization::all()->pluck('name_ru', 'id');
        $clinicList = $this->findClinicByType($type_id, $city_id, $region_id);


        if (!empty($region_id)) {
            $children = Region::where('parent_id', $region_id)->pluck('id')->toArray();
            $query->whereIn('region_id', $children);
        }
        if (!empty($city_id)) {
            $query->where('region_id', $city_id);
        }
        if (!empty($type_id)) {
            $query->where('type', $type_id);
        }

        if (!empty($value = $request->get('clinic'))) {
            $query->where('id', $value);
        }
        if (!empty($value = $request->get('name'))) {
            $query->whereHas('doctors', function ($query1) use ($value) {
                        $query1->where('name', 'ilike', '%' . $value . '%')
                        ->orWhere('last_name', 'ilike', '%' . $value . '%');
                    })
                    ->orWhereHas('doctors.specializations', function ($query2) use ($value) {
                        $query2->where('name_ru', 'ilike', '%' . $value . '%')
                        ->orWhere('name_uz', 'ilike', '%' . $value . '%');
                    });
        }

        $clinics = $query->paginate(20);

        return view('admin.call-center.index', compact('clinics', 'regionList', 'cityList', 'clinicTypeList', 'specList', 'clinicList'));
    }

    public function findDoctorByRegion(Request $request) {
        $region_id = $request->get('region');
        $result = $this->findCityByRegion($region_id);
        $clinics = $this->findClinicByRegion($region_id);

        $data = ['cities' => $result, 'clinics' => $clinics];


        return json_encode($data);
    }

    public function findDoctorByType(Request $request) {
        $region_id = $request->get('region');
        $city_id = $request->get('city');
        $type_id = $request->get('type');

        $result = $this->findClinicByType($type_id, $city_id, $region_id);

        return json_encode($result);
    }

    public function findCityByRegion($region_id) {
        if (!empty($region_id)) {
            $result = Region::where('parent_id', $region_id)->pluck('name_ru', 'id');
        }

        if (empty($region_id)) {
            $result = Region::whereNotNull('parent_id')->pluck('name_ru', 'id');
        }

        return $result;
    }

    public function findClinicByType($type_id, $city_id, $region_id) {
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

    public function findClinicByRegion($region_id) {
        $query = Clinic::orderBy('id');

        if (!empty($region_id)) {
            $regionList = Region::where('parent_id', $region_id)->pluck('id')->toArray();
            $query->whereIn('region_id', $regionList);
        }

        $result = $query->pluck('name_ru', 'id');

        return $result;
    }

    public function booking(User $user, Clinic $clinic, Request $request) {
        $user1 = User::find($user->id);
        $clinic1 = Clinic::find($clinic->id);
        $calendar = $request['calendar'];
        $radioTime = $request['radio_time'];

        $b_users = Book::where('doctor_id', $user1->id)
                ->where('clinic_id', $clinic1->id)
                ->get();

        return view('admin.call-center.booking', compact('user1', 'clinic1', 'b_users', 'calendar', 'radioTime'));
    }

    public function bookingDoctor(Request $request) {
        $user = User::newGuest(
                        $request['first_name'],
                        $request['last_name'],
                        $request['middle_name'],
                        $request['phone'],
                        $request['birth_date'],
                        $request['gender'],
                        $request['email']
        );
        $doctorId = $request['doctor_id'];
        $clinicId = $request['clinic_id'];
        $bookingDate = $request['booking_date'];
        $timeStart = $request['time_start'];
        $description = $request['description'];


        $booking = Book::new($user->id, $doctorId, $clinicId, $bookingDate, $timeStart, null, $description);


        return redirect()->route('admin.call-center.index');
    }

    public function bookingTime(User $user, Clinic $clinic) {
        $user1 = User::find($user->id);
        $clinic1 = Clinic::find($clinic->id);
        $spec1 = $user->specializations;
        $currentDate = Carbon::now()->addDays(3)->format('Y-m-d');

        $doctorTimetable = Timetable::where('doctor_id', $user->id)
                ->where('clinic_id', $clinic->id)
                ->first();

        $celebration = Celebration::orderByDesc('id');
        $celebrationDays = $celebration->pluck('date')->toArray();

        $start = Carbon::now()->startOfMonth();
        $end = Carbon::now()->endOfMonth();

        $period = CarbonPeriod::between($start, $end);

        $docDayOfWeeks = $this->getDaysConst($doctorTimetable);

        $daysOff = array();
        $daysOff1 = array();
        $daysOff2 = array();
        $timeSlots = array();

        foreach ($period as $date) {
            if (!empty($docDayOfWeeks)) {
                foreach ($docDayOfWeeks as $docDayOfWeek) {
                    if ($date->dayOfWeek == $docDayOfWeek) {
                        $daysOff1[] = $date->format('Y-m-d');
                    }
                }
            } else {
                $daysOff1[] = $date->format('Y-m-d');
            }
        }

        if (!empty($celebrationDays)) {
            foreach ($celebrationDays as $celeb) {
                $daysOff2[] = Carbon::createFromFormat('Y-m-d H:i:s', $celeb)->format('Y-m-d');
            }
        }

        if (!empty($daysOff2)) {
            $daysOff = array_merge($daysOff1, $daysOff2);
        } else {
            $daysOff = $daysOff1;
        }

        $duration = $this->getTime($doctorTimetable, $currentDate);
        if (!empty($duration['start']) && !empty($duration['end']) && !empty($duration['inter'])) {
            $timeSlots = $this->getTimes($duration['start'], $duration['end'], $duration['inter']);
        }


        unset($period);
        unset($daysOff1);
        unset($daysOff2);

        return view('admin.call-center.booking-time', compact('user1', 'clinic1', 'spec1', 'currentDate', 'daysOff', 'timeSlots'));
    }

    public function getDaysConst(Timetable $timetable) {

        $daysConst = array();

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

        return $daysConst;
    }

    public function getTimes(string $startTime, string $endTime, int $interval) {
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
            function getTime(Timetable $timetable, string $date) {
        $carbon = Carbon::createFromFormat('Y-m-d', $date);
        $time = array();

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

        return $time;
    }

}
