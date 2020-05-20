<?php

namespace App\Http\Controllers\Admin\CallCenter;

use App\Http\Controllers\Controller;
use App\User;
use App\Region;
use App\Clinic;
use App\Specialization;
use App\CallCenterDoctor;
use Illuminate\Http\Request;

class CallCenterController extends Controller
{
    public function index(Request $request)
    {
        $clinics = Clinic::with(['users.specializations'])->where('id', $request->get('clinic'))->get();

        $categories = Region::children(null);
        $regions = Region::orderBy('regions.id', 'asc')
                ->paginate(1000000);
        $clinicTypeList = Clinic::clinicTypeList();
        $specList = Specialization::all()->pluck('name_ru', 'id');

        return view('admin.callcenter.index', compact('temps', 'clinics', 'regions', 'categories', 'clinicTypeList', 'specList'));
    }

    public function findCity1($id)
    {
        $city = Region::where('parent_id', $id)->pluck('name_ru', 'id');
        return json_encode($city);
    }

    public function findClinicByType($id, $region_id)
    {
        $clinic = Clinic::where([['type', $id], ['region_id', $region_id]])->pluck('name_ru', 'id');
        return json_encode($clinic);
    }
}
