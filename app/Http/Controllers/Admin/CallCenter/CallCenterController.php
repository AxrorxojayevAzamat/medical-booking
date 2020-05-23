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

        $query = Clinic::with(['users', 'users.specializations']);


        $categories = Region::children(null);
        $regions = Region::orderBy('regions.id', 'asc')
                ->paginate(1000000);
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
        
//        $('select[name="region"]').append('<option value="' + key + '" key==request(\'region\') ? \' selected\' : \'\'>' + value + '</option>');

        $clinics = $query->paginate(20);

        return view('admin.callcenter.index', compact('clinics', 'regions', 'categories', 'clinicTypeList', 'specList', 'clinicList'));
    }

    public function findCity1($id)
    {
        $city = Region::where('parent_id', $id)->pluck('name_ru', 'id');
        return json_encode($city);
    }

    public function findClinicByType(Request $request)
    {
        $query = Clinic::orderBy('id');

        if (!empty($value = $request->get('type_id'))) {
            $query->where('type', $value);
        }

        if (!empty($value = $request->get('region_id'))) {
            $query->where('region_id', $value);
        }

        $clinic = $query->pluck('name_ru', 'id');
        return json_encode($clinic);
    }
}
