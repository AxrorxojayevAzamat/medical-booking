<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Entity\Clinic\Clinic;

class ClinicController extends Controller
{

    public function map(Clinic $clinic)
    {
        return view('clinics.map', compact('clinic'));
    }

}
