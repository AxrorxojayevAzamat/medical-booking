<?php

namespace App\Http\Controllers\Doctor;

use App\Entity\Book\Book;
use App\Entity\User\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Entity\Clinic\DoctorClinic;
use App\Entity\Clinic\DoctorSpecialization;
use App\Entity\Clinic\Specialization;
use App\Entity\Region;
use App\Helpers\LanguageHelper;
use Illuminate\Http\Request;
use App\Entity\Clinic\Clinic;
use App\Entity\Clinic\Timetable;
use App\Entity\Celebration;
use App\Services\BookService;

class DoctorController extends Controller
{

    private $service;

    public function __construct(BookService $service)
    {
        $this->service = $service;
    }

    public function profileShow()
    {
        $bookings = User::find(Auth::user()->id);
        return view('doctor.profile', compact('bookings'));
    }

    public function books($doctor_id)
    {

        $bookings = Book::where('doctor_id', $doctor_id)->get();


        return view('doctor.doctor_bookings', compact('bookings'));
    }

    public function index(Request $request)
    {
        $doctorIds = [];
        $query = User::select(['users.*', 'pr.*'])
                ->leftJoin('profiles as pr', 'users.id', '=', 'pr.user_id')
                ->doctor();

        if (!empty($value = $request->get('full_name'))) {
            $query->where(function ($query) use ($value) {
                $query->whereRaw("concat(pr.last_name, ' ', pr.first_name, ' ', pr.middle_name) like '%$value%'")
                        ->orWhereRaw("concat(pr.first_name, ' ', pr.middle_name, ' ', pr.last_name) like '%$value%'");
            });
        }

        if (!empty($value = $request->get('clinic'))) {
            $doctorIds = array_merge($doctorIds, DoctorClinic::where('clinic_id', $value)->pluck('doctor_id')->toArray());
        }

        if (!empty($value = $request->get('specialization'))) {
            $doctorIds = array_merge($doctorIds, DoctorSpecialization::where('specialization_id', $value)->pluck('doctor_id')->toArray());
        }

        if (!empty($value = $request->get('region'))) {
            $regionIds = $this->getRegionIds($value);

            $doctorIds = array_merge($doctorIds, DoctorClinic::select('doctor_clinics.doctor_id')
                            ->leftJoin('clinics as c', 'doctor_clinics.clinic_id', '=', 'c.id')
                            ->whereIn('c.region_id', $regionIds)->pluck('doctor_clinics.doctor_id')->toArray());
        }

        if (!empty($doctorIds)) {
            $doctorIds = array_unique($doctorIds);
            $query->whereIn('users.id', $doctorIds);
        }

        if (!empty($value = $request->get('gender'))) {
            $query->where('pr.gender', $value);
        }

        if (!empty($value = $request->get('order_by'))) {
            if ($value == 'alphabet') {
                $query->orderBy('pr.last_name')->orderBy('pr.first_name')->orderBy('pr.middle_name');
            } elseif ($value == 'best_rated') {
                $query->orderByDesc('pr.rating');
            }
        }
        $query->orderByDesc('users.created_at');

        $doctors = $query->paginate(10);

        $countAll = User::doctor()->count();
        $countCurrent = count($doctors);

        $regions = Region::where('parent_id', null)->pluck('name_' . LanguageHelper::getCurrentLanguagePrefix(), 'id');
        $clinics = Clinic::pluck('name_' . LanguageHelper::getCurrentLanguagePrefix(), 'id');
        $specializations = Specialization::pluck('name_' . LanguageHelper::getCurrentLanguagePrefix(), 'id');
        
        $clinicLocations = array();
        foreach ($doctors as $key => $value) {
            
           $clinicLocations[] = [   'doctorId' => $value->id,
                                    'locations' => $value->clinics()->pluck('location')->toArray()
                                ];
        }
        $clinicLocationsJson = json_encode($clinicLocations);
        return view('doctors.index', compact('doctors', 'regions', 'clinics', 'specializations', 'countAll', 'countCurrent','clinicLocationsJson'));
    }

    private function getRegionIds($regionId): array
    {
        $region = Region::find($regionId);
        $allRegionIds = [$region->id];
        $regionIds = [$region->id];

        while (true) {
            $regionIds = Region::whereIn('parent_id', $regionIds)->pluck('id')->toArray();
            if (!$regionIds) {
                break;
            }
            $allRegionIds += $regionIds;
        }

        return $allRegionIds;
    }

    public function show(User $user)
    {
        $clinicsId = $user->clinics->pluck('id')->toArray();
        $clinics = Clinic::whereIn('id', $clinicsId)
                ->orderByDesc('id')
                ->get();
        $specs = $user->specializations;
        $doctorTimetables = Timetable::where('doctor_id', $user->id)
                ->whereIn('clinic_id', $clinicsId)
                ->orderByDesc('clinic_id')
                ->get();

        $celebrationDays = Celebration::orderByDesc('id')->get();

        $doctorBooks = Book::where('doctor_id', $user->id)
                ->whereIn('clinic_id', $clinicsId)
                ->orderByDesc('clinic_id')
                ->get();

        $holidays = $this->service->celebrationDays($celebrationDays);

        return view('doctors.show', compact('user', 'clinics', 'specs', 'doctorTimetables', 'doctorBooks', 'holidays'));
    }

}
