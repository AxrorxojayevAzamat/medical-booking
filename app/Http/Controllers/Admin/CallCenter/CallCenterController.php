<?php

namespace App\Http\Controllers\Admin\CallCenter;

use App\Http\Controllers\Controller;
use App\User;
use App\Region;
use App\Clinic;
use App\Specialization;
use App\CallCenterDoctor;
use App\DoctorClinic;
use App\SpecializationUser;
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
        $clinicList = $this->findClinicByType($type_id, $city_id);


        if (!empty($value = $request->get('region'))) {
            $query->where('region_id', $value);
        }
        if (!empty($value = $request->get('type'))) {
            $query->where('type', $value);
        }

        if (!empty($value = $request->get('clinic'))) {
            $query->where('id', $value);
        }
        if (!empty($value = $request->get('spec'))) {
            $query->whereHas('users.specializations', function ($query) use ($value) {
                $query->where('id', $value);
            });
        }

        $bla = $request->get('region');

        $clinics = $query->paginate(20);

        return view('admin.callcenter.index', compact('clinics', 'regionList', 'cityList', 'clinicTypeList', 'specList', 'clinicList', 'bla'));
    }

    public function findDoctorByRegion(Request $request)
    {
        $region_id = $request->get('region');
        $result = $this->findCityByRegion($region_id);

        return json_encode($result);
    }

    public function findDoctorByType(Request $request)
    {
        $city_id = $request->get('city');
        $type_id = $request->get('type');

        $result = $this->findClinicByType($type_id, $city_id);

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

    public function findClinicByType($type_id, $city_id)
    {
        $query = Clinic::orderBy('id');

        if (!empty($city_id)) {
            $query->where('region_id', $city_id);
        }

        if (!empty($type_id)) {
            $query->where('type', $type_id);
        }

        $result = $query->pluck('name_ru', 'id');

        return $result;
    }
}
