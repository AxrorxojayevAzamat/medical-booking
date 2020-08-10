<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\BookService;

class CallCenterController extends Controller
{

    private $service;

    public function __construct(BookService $service)
    {
        $this->service = $service;
    }

    public function findDoctorByRegion(Request $request)
    {
        try {
            return $this->service->findDoctorByRegion($request);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function findDoctorByType(Request $request)
    {
        try {
            $region_id = $request->get('region');
            $city_id = $request->get('city');
            $type_id = $request->get('type');

            return $this->service->findClinicByType($type_id, $city_id, $region_id);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function paymeEndpoint(Request $request)
    {
//        if ($user->phone) {
//            $this->bookService->toSms($userId, $doctorId, $clinicId, $bookingDate, $timeStart);
//        }
//        $this->bookService->toMail($userId, $doctorId, $clinicId, $bookingDate, $timeStart);
    }

    public function clickEndpoint(Request $request)
    {
//        if ($user->phone) {
//            $this->bookService->toSms($userId, $doctorId, $clinicId, $bookingDate, $timeStart);
//        }
//        $this->bookService->toMail($userId, $doctorId, $clinicId, $bookingDate, $timeStart);
    }

}
