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
use App\UseCases\Book\BookService;

class CallCenterController extends Controller {

    private $service;

    public function __construct(BookService $service) {
        $this->service = $service;
//        $this->middleware('can:manage-adverts');
    }

    public function index(Request $request) {

        $region_id = $request->get('region');
        $city_id = $request->get('city');
        $type_id = $request->get('type');

        $query = Clinic::with(['doctors', 'doctors.specializations']);


        $regionList = Region::where('parent_id', null)->pluck('name_ru', 'id');
        $cityList = $this->service->findCityByRegion($region_id);

        $clinicTypeList = Clinic::clinicTypeList();
        $specList = Specialization::all()->pluck('name_ru', 'id');
        $clinicList = $this->service->findClinicByType($type_id, $city_id, $region_id);


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
        try {
            $this->service->findDoctorByRegion($request);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function findDoctorByType(Request $request) {
        try {
            $region_id = $request->get('region');
            $city_id = $request->get('city');
            $type_id = $request->get('type');

            $result = $this->service->findClinicByType($type_id, $city_id, $region_id);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }
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

        $currentDate = Carbon::now()->format('Y-m-d');

        $doctorTimetable = Timetable::where('doctor_id', $user->id)
                ->where('clinic_id', $clinic->id)
                ->first();

        $celebrationDays = Celebration::orderByDesc('id')->get();

        $doctorBooks = Book::where('doctor_id', $user1->id)
                        ->where('clinic_id', $clinic1->id)->get();

        $start = Carbon::now()->startOfMonth();
        $end = Carbon::now()->endOfMonth();
        $restStart = Carbon::createFromFormat('Y-m-d', $doctorTimetable->day_off_start);
        $restEnd = Carbon::createFromFormat('Y-m-d', $doctorTimetable->day_off_end);

        $docDayOfWeeks = $this->service->getDaysConst($doctorTimetable);

        $daysOff = array();
        $daysOff1 = $this->service->daysDisabled($docDayOfWeeks, $start, $end);
        $daysOff2 = $this->service->celebrationDays($celebrationDays);
        $daysOff3 = $this->service->restDays($restStart, $restEnd);

        $timeSlots = $this->service->timeSlots($doctorTimetable, $currentDate);


        if (!empty($daysOff2)) {
            $daysOff = array_merge($daysOff1, $daysOff2, $daysOff3);
        } else {
            $daysOff = array_merge($daysOff1, $daysOff3);
        }

        return view('admin.call-center.booking-time', compact('user1', 'clinic1', 'spec1', 'currentDate', 'daysOff', 'timeSlots', 'doctorTimetable', 'doctorBooks'));
    }

}
