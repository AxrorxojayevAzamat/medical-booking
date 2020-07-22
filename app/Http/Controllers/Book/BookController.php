<?php

namespace App\Http\Controllers\Book;

use App\Entity\Clinic\DoctorClinic;
use App\Entity\Clinic\DoctorSpecialization;
use App\Entity\Clinic\Specialization;
use App\Entity\Region;
use App\Helpers\LanguageHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entity\User\User;
use App\Entity\Clinic\Timetable;
use App\Entity\Celebration;
use App\Entity\Book\Book;
use App\Entity\Clinic\Clinic;
use App\Services\BookService;
use Carbon\Carbon;
use Auth;
use App\Entity\Rate;
use App\Entity\User\Profile;
use Redirect;

class BookController extends Controller {

    private $service;

    public function __construct(BookService $service) {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $doctorIds = [];
        $query = User::select(['users.*', 'pr.*'])
            ->leftJoin('profiles as pr', 'users.id', '=', 'pr.user_id')
            ->join('timetables as ts', 'users.id', '=', 'ts.doctor_id')
            ->join('doctor_clinics as dc', 'users.id', '=', 'dc.doctor_id')
            ->join('doctor_specializations as ds', 'users.id', '=', 'ds.doctor_id')
            ->groupBy(['users.id', 'pr.user_id'])
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

        return view('book.index', compact('doctors', 'regions', 'clinics', 'specializations', 'countAll', 'countCurrent'));
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
        if(!$user->isDoctor()){
            return redirect()->back()->with('error', 'You are injecting code');      
        }
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


        $ratecheck = Rate::where(['user_id'=>Auth::id(),'doctor_id'=>$user->id])->first();

        $rates = array();
        for ($i=5; $i > 0 ; $i--) { 
            array_push($rates, Rate::where(['doctor_id'=>$user->id,'rate'=>$i])->count());
        }
        return view('book.show', compact('user', 'clinics', 'specs', 'doctorTimetables', 'doctorBooks', 'holidays','ratecheck','rates'));
    }

    public function review(User $user)
    {
        return view('book.review');
    }

    public function rate(Request $request){
        
        
        if(!Auth::check()){
            //return redirect()->route('login');   
            return redirect()->intended('login');
        }

        if($request->rate<1 || $request->rate>5){
            return redirect()->back()->with('error', 'You are injecting code');      
        }


        $rates = Rate::create([
            'user_id'=>Auth::id(),
            'doctor_id'=>$request->doctor_id,
            'rate'=>$request->rate
        ]);

        $doctor = Profile::find($request->doctor_id);
        $doctor->rate += $request->rate;
        $doctor->num_of_rates++;
        $doctor->save();

        return redirect()->back()->with('success', 'Successfully Rated');   

    }

    public function rateCancel(Request $request){
        
        $user_rate = Rate::where(['user_id'=>Auth::id(),'doctor_id'=>$request->doctor_id])->first();
        if (!$user_rate) {
            return redirect()->back()->with('success', 'Your Rate Canceled');    
        }
        $doctor = Profile::find($request->doctor_id);
        $doctor->rate -= $user_rate->rate;
        $doctor->num_of_rates--;
        $doctor->save();
        
        $user_rate->delete();

        return redirect()->back()->with('success', 'Your Rate Canceled');   
    }
}
