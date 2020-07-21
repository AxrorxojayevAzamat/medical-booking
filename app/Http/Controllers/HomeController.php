<?php

namespace App\Http\Controllers;

use App\Entity\User\User;
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

        return view('home', compact('bestRatedDoctors'));
    }
}
