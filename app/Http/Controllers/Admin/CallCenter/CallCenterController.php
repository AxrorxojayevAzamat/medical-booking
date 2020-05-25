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
        $query = Clinic::with(['users', 'users.specializations']);


        $regionList = Region::children(null)->pluck('name_ru', 'id');

        $clinicTypeList = Clinic::clinicTypeList();
        $specList = Specialization::all()->pluck('name_ru', 'id');
        $clinicList = Clinic::all()->pluck('name_ru', 'id');


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

        $clinics = $query->paginate(20);

        return view('admin.callcenter.index', compact('clinics', 'regionList', 'clinicTypeList', 'specList', 'clinicList'));
    }

    public function findDoctor(Request $request)
    {
        $result = null;
        $region_id = $request->get('region_id');
        $city_id = $request->get('city_id');
        $type_id = $request->get('type_id');

        if (!empty($region_id)) {
            $result = Region::where('parent_id', $region_id)->pluck('name_ru', 'id');
        }

        if (!empty($city_id) || !empty($type_id)) {
            $query = Clinic::orderBy('id');

            if (!empty($type_id)) {
                $query->where('type', $type_id);
            }

            if (!empty($city_id)) {
                $query->where('region_id', $city_id);
            }

            $result = $query->pluck('name_ru', 'id');
        }
        return json_encode($result);
    }
}
