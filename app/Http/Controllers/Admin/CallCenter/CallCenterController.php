<?php

namespace App\Http\Controllers\Admin\CallCenter;

use App\Http\Controllers\Controller;
use App\User;
use App\Region;
use App\Clinic;
use App\Specialization;
use App\Booking;
use App\Timetable;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class CallCenterController extends Controller {

    public function index(Request $request) {

        $region_id = $request->get('region');
        $city_id = $request->get('city');
        $type_id = $request->get('type');

        $query = Clinic::with(['users', 'users.specializations']);


        $regionList = Region::children(null)->pluck('name_ru', 'id');
        $cityList = $this->findCityByRegion($region_id);

        $clinicTypeList = Clinic::clinicTypeList();
        $specList = Specialization::all()->pluck('name_ru', 'id');
        $clinicList = $this->findClinicByType($type_id, $city_id, $region_id);


        if (!empty($region_id)) {
            $childrens = Region::where('parent_id', $region_id)->pluck('id')->toArray();
            $query->whereIn('region_id', $childrens);
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
            $query->whereHas('users', function ($query1) use ($value) {
                        $query1->where('name', 'ilike', '%' . $value . '%')
                        ->orWhere('lastname', 'ilike', '%' . $value . '%');
                    })
                    ->orWhereHas('users.specializations', function ($query2) use ($value) {
                        $query2->where('name_ru', 'ilike', '%' . $value . '%')
                        ->orWhere('name_uz', 'ilike', '%' . $value . '%');
                    });
        }

        $clinics = $query->paginate(20);

        return view('admin.callcenter.index', compact('clinics', 'regionList', 'cityList', 'clinicTypeList', 'specList', 'clinicList'));
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
        $calendar2 = $request['calendar2'];
        $radioTime = $request['radio_time'];

//        $b_users = Booking::all();
        $b_users = Booking::where('doctor_id', $user1->id)
                ->where('clinic_id', $clinic1->id)
                ->get();

        return view('admin.callcenter.booking', compact('user1', 'clinic1', 'b_users', 'calendar2', 'radioTime'));
    }

    public function bookingDoctor(Request $request) {
        $user = User::newGuest(
                        $request['name'],
                        $request['lastname'],
                        $request['patronymic'],
                        $request['phone'],
                        $request['birth_date'],
                        $request['gender'],
                        $request['email']
        );
        $doctorId = $request['doctor_id'];
        $clinicId = $request['clinic_id'];
        $bookingDate = $request['booking_date'];
        $timeStart = $request['time_start'];

        $booking = Booking::new($user->id, $doctorId, $clinicId, $bookingDate, $timeStart, null, null, null);


        return redirect()->route('admin.callcenter.index');
    }

    public function bookingTime(User $user, Clinic $clinic) {
        $user1 = User::find($user->id);
        $clinic1 = Clinic::find($clinic->id);
        $currentDate = Carbon::now()->format('Y-m-d');

        $doctorSchedule = Timetable::where('doctor_id', $user1->id)
                        ->where('clinic_id', $clinic1->id)->first();


        $doctorDates = array();
        $doctorDates2 = array();
        $doctorTimes = array();
        $bookingTimes = array();
        $daysOn = array();
        $daysOff = array();

        if (empty($doctorSchedule->monday_start)) {
            array_push($doctorDates, Carbon::MONDAY);
        } else {
            array_push($doctorTimes, $doctorSchedule->monday_start);
        }
        if (empty($doctorSchedule->tuesday_start)) {
            array_push($doctorDates, Carbon::TUESDAY);
        } else {
            array_push($doctorTimes, $doctorSchedule->tuesday_start);
        }
        if (empty($doctorSchedule->wednesday_start)) {
            array_push($doctorDates, Carbon::WEDNESDAY);
        } else {
            array_push($doctorTimes, $doctorSchedule->wednesday_start);
        }
        if (empty($doctorSchedule->thursday_start)) {
            array_push($doctorDates, Carbon::THURSDAY);
        } else {
            array_push($doctorTimes, $doctorSchedule->thursday_start);
        }
        if (empty($doctorSchedule->friday_start)) {
            array_push($doctorDates, Carbon::FRIDAY);
        } else {
            array_push($doctorTimes, $doctorSchedule->friday_start);
        }

        if (empty($doctorSchedule->saturday_start)) {
            array_push($doctorDates, Carbon::SATURDAY);
        } else {
            array_push($doctorTimes, $doctorSchedule->saturday_start);
        }
        if (empty($doctorSchedule->sunday_start)) {
            array_push($doctorDates, Carbon::SUNDAY);
        } else {
            array_push($doctorTimes, $doctorSchedule->sunday_start);
        }

        $start = Carbon::now()->startOfMonth();
        $end = Carbon::now()->endOfMonth();


        $period = CarbonPeriod::between($start, $end);


        foreach ($period as $date) {
            foreach ($doctorDates as $docDate) {
                if ($date->dayOfWeek == $docDate) {
                    $daysOff[] = $date->format('Y-m-d');
                }
            }
        }
        foreach ($period as $date) {
            $doctorDates2[] = $date->format('Y-m-d');
        }

        $doctorBooking = Booking::where('doctor_id', $user1->id)
                        ->where('clinic_id', $clinic1->id)->get();

        foreach ($doctorBooking as $docBooking) {
            if (!empty($docBooking->time_start)) {
                array_push($bookingTimes, $docBooking->time_start);
            } else {
                
            }
        }

        $reseptionTimes = array_diff($doctorTimes, $bookingTimes);

        $daysOn = array_diff($doctorDates2, $daysOff);

        unset($period);
        unset($bookingTimes);

        return view('admin.callcenter.booking-time', compact('user1', 'clinic1', 'currentDate', 'daysOff', 'reseptionTimes', 'daysOn', 'doctorDates2'));
    }

}
