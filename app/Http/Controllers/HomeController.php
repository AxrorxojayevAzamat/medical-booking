<?php

namespace App\Http\Controllers;

use App\Entity\Clinic\Specialization;
use App\Entity\Region;
use App\Entity\User\User;
use App\Helpers\LanguageHelper;

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

        $specializations = Specialization::orderBy('name_' . LanguageHelper::getCurrentLanguagePrefix())->limit(9)->get();

        return view('home', compact('bestRatedDoctors', 'regions', 'specializations'));
    }
}
