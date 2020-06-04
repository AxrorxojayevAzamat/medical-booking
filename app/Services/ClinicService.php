<?php

namespace App\Services;

use App\Clinic;
use App\Http\Requests\ClinicRequest;

class ClinicService
{
    public function create(ClinicRequest $request)
    {
        $store = Clinic::findOrFail($request->id);
    }
}
