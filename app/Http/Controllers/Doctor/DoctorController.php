<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;

class DoctorController extends Controller {

    public function index() {
        return view('doctor.page');
    }

    public function profile_show() {
        return view('doctor.profile');
    }
}
