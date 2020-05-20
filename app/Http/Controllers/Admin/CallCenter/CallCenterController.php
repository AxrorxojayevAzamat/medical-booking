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

class CallCenterController extends Controller {

    public function index(Request $request) {
        $query = Clinic::orderBy('id');


        $categories = Region::children(null);
        $regions = Region::orderBy('regions.id', 'asc')
                ->paginate(1000000);
        $clinicTypeList = Clinic::clinicTypeList();
        $specList = Specialization::all()->pluck('name_ru', 'id');


        if (!empty($value = $request->get('region'))) {
            $query->where('region_id', $value)->pluck('id')->toArray();
        }
        if (!empty($value = $request->get('type'))) {
            $query->where('type', $value)->pluck('id')->toArray();
        }


        $query = Clinic::with(['users', 'users.specializations'])->whereIn('id', $query->pluck('id')->toArray());
        $clinics = $query->paginate(20);

        return view('admin.callcenter.index', compact('clinics', 'regions', 'categories', 'clinicTypeList', 'specList'));
    }

    public function findCity1($id) {
        $city = Region::where('parent_id', $id)->pluck('name_ru', 'id');
        return json_encode($city);
    }

    public function findClinicByType($id) {

            $clinic = Clinic::where(['region_id', $id])->pluck('id');
        return json_encode($clinic);
    }

}
