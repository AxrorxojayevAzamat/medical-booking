<?php

namespace App\Http\Controllers;

use App\Entity\Clinic\Clinic;
use App\Entity\Clinic\Service;
use App\Entity\Clinic\Specialization;
use App\Entity\Region;
use App\Entity\User\User;
use App\Entity\Page;
use App\Helpers\LanguageHelper;
use Session;

class HomeController extends Controller
{
    public function index()
    {
        $bestRatedDoctors = User::select(['users.*', 'pr.*'])
            ->leftJoin('profiles as pr', 'users.id', '=', 'pr.user_id')
            ->join('timetables as ts', 'users.id', '=', 'ts.doctor_id')
            ->join('doctor_clinics as dc', 'users.id', '=', 'dc.doctor_id')
            ->join('doctor_specializations as ds', 'users.id', '=', 'ds.doctor_id')
            ->doctor()
            ->groupBy(['users.id', 'pr.user_id'])
            ->orderByDesc('pr.rate')
            ->limit(5)
            ->get();

        $regions = Region::where('parent_id', null)
            ->orderBy('name_' . LanguageHelper::getCurrentLanguagePrefix())
            ->limit(9)->get();

        $name = 'name_' . LanguageHelper::getCurrentLanguagePrefix();

        $pages = Page::all();
        Session::put('pages', $pages);

        $specializations = Specialization::orderBy($name)->limit(9)->get();
        $services = Service::select(['services.*'])
            ->withCount('serviceClinics')
            ->orderByDesc('service_clinics_count')
            ->orderBy($name)->limit(8)->get();

        $polyclinicCount = Clinic::where('type', Clinic::CLINIC_TYPE_GOVERNMENT)->count();
        $privateClinicCount = Clinic::where('type', Clinic::CLINIC_TYPE_PRIVATE)->count();
        $doctorCount = User::active()->doctor()->count();

        return view('home', compact('bestRatedDoctors', 'regions', 'specializations', 'services',
            'polyclinicCount', 'privateClinicCount', 'doctorCount'));
    }
}
