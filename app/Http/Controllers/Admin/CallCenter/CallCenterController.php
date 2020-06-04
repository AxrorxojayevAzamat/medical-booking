<?php

namespace App\Http\Controllers\Admin\CallCenter;

use App\Http\Controllers\Controller;
use App\User;
use App\Region;
use App\Clinic;
use App\Specialization;
use App\Booking;
use Illuminate\Http\Request;

class CallCenterController extends Controller
{
    public function index(Request $request)
    {
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

    public function booking(User $user, Clinic $clinic)
    {
        $user1 = User::find($user->id);
        $clinic1 = Clinic::find($clinic->id);

//        $b_users = Booking::all();
        $b_users = Booking::where('doctor_id', $user1->id)
                ->where('clinic_id', $clinic1->id)
                ->get();

        return view('admin.callcenter.booking', compact('user1', 'clinic1', 'b_users'));
    }

    public function bookingDoctor(Request $request)
    {
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
}
