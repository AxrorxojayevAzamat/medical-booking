<?php

namespace App\Http\Controllers;

use App\Entity\Clinic\Specialization;
use App\Entity\Region;
use App\Entity\User\User;
use App\Helpers\LanguageHelper;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
//        $bestRatedDoctors = User::select(['users.*', 'profile.*'])
//            ->leftJoin('profiles as pr', 'users.id', '=', 'pr.user_id')
//            ->doctor()
//            ->orderByDesc('pr.rate')
//            ->limit(5)
//            ->get();

        $regions = Region::where('parent_id', null)
            ->orderBy('name_' . LanguageHelper::getCurrentLanguagePrefix())
            ->limit(9)->get();

        $specializations = Specialization::orderBy('name_' . LanguageHelper::getCurrentLanguagePrefix())->limit(9)->get();

        return view('home', compact('bestRatedDoctors', 'regions', 'specializations'));
    }
}
