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
use App\Http\Requests\TimeTableRequest;
use App\Entity\Celebration;
use App\Services\BookService;
use App\Entity\Rate;
use App\Entity\User\Profile;
use Hash;


class DoctorController extends Controller
{

    private $service;

    public function __construct(BookService $service)
    {
        $this->service = $service;
    }

    public function profileShow()
    {
        $user = User::find(Auth::id());
        $book_num = count(Book::where('doctor_id', $user->id)->get());
        $doctor = User::find(Auth::id());
        $timetable = Timetable::where('doctor_id', Auth::id())->get();
        
        
        $specializations = DoctorSpecialization::where('doctor_id',$user->id)->get();
        $clinics = Clinic::orderBy('name_ru')->pluck('name_ru', 'id');

        return view('doctor.profile.index', compact('user','book_num','doctor','timetable','specializations','clinics'));
    }
    public function profileEdit(User $user)
    {
        $user = User::find(Auth::user()->id);
        $specializations = Specialization::orderBy('name_ru')->pluck('name_ru', 'id');
        $book_num = count(Book::where('doctor_id', $user->id)->get());
        return view('doctor.profile.edit', compact('user','book_num','specializations'));
    }
    public function profileEditSave(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'string', 'regex:/^[+]?\d{9,18}$/'],
        ]);
        $user = User::find(Auth::id());
        if($request->oldpass){
            if(Hash::check($request->oldpass, $user->password))
                if($request->newpass == $request->confpass)
                    $request->newpass?$user->password=bcrypt($request->newpass):'';  
                else
                    return redirect()->back()->with('newpass', 'false');  
            else
                return redirect()->back()->with('oldpass', 'false');      
        }   
        $request->phone?$user->phone = $request->phone:'';
        $request->email?$user->email = $request->email:'';
        $user->save();

        return redirect()->back()->with('success', 'Successfully Edited');   
    }

    public function books($doctor_id)
    {
        $bookings = Book::where('doctor_id', $doctor_id)->get();
        $bookings = $bookings->sortBy('booking_date');
        $user = User::find(Auth::user()->id);
        $book_num = count(Book::where('doctor_id', $user->id)->get());
        return view('doctor.doctor_bookings', compact('bookings','user','book_num'));
    }

    public function storeSpecializations(Request $request, User $user)
    {
        $user->specializations()->sync($request['specializationUser']);
        return redirect()->back()->with('success', 'Successfully Edited');
    }

    public function specializations(User $user)
    {
        $user = User::find(Auth::user()->id);
        $specializations = Specialization::orderBy('name_ru')->pluck('name_ru', 'id');
        $book_num = count(Book::where('doctor_id', $user->id)->get());
        return view('doctor.specializations', compact('user','specializations','book_num'));
    }

    public function timetable()
    {
        $doctor = User::find(Auth::id());
        $timetable = Timetable::where('doctor_id', Auth::id())->get();
        $specializations = Specialization::orderBy('name_ru')->pluck('name_ru', 'id');
        $clinics = Clinic::orderBy('name_ru')->pluck('name_ru', 'id');
        $book_num = count(Book::where('doctor_id', Auth::id())->get());
        
        return view('doctor.timetable.index', compact('book_num', 'specializations', 'doctor', 'clinics', 'timetable'));
    }

    public function edit(Clinic $clinic)
    {
        $user=Auth::user();
        $clinic = $clinic;
        $book_num = count(Book::where('doctor_id', $user->id)->get());
        
        $timetable = Timetable::where('doctor_id', $user->id)->where('clinic_id', $clinic->id)->first();
        return view('doctor.timetable.edit', compact('timetable', 'user', 'clinic','book_num'));
    }

    public function update(TimeTableRequest $request,User $user, Timetable $timetable)
    {
        if($timetable->odd_start){
            $odd_start_check = Book::where(
                'doctor_id', $user->id)
        ->where('time_start','<',$request->odd_start)->first();
            
            $odd_finish_check = Book::where(
                'doctor_id', $user->id)
        ->where('time_finish','>',$request->odd_end)->first();
            
            if($odd_start_check || $odd_finish_check)
                return redirect()->back()->with('error', 'true');
            }

            if($timetable->even_start){
            $even_start_check = Book::where(
                'doctor_id', $user->id)
        ->where('time_start','<',$request->even_start)->first();

            $even_finish_check = Book::where(
                'doctor_id', $user->id)
        ->where('time_finish','>',$request->even_end)->first();
                
            if($even_start_check || $even_finish_check)
                return redirect()->back()->with('error', 'true');
            }
        try {
            $bookings = Book::where('doctor_id', $doctor_id)->get();
            
            $timetable=$this->service->update($timetable->id, $request);

            return redirect()->route('doctor.timetable.index', Auth::user())->with('success', 'Расписание обновлено');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
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
                $query->whereRaw("concat(pr.last_name, ' ', pr.first_name, ' ', pr.middle_name) ilike '%$value%'")
                    ->orWhereRaw("concat(pr.first_name, ' ', pr.middle_name, ' ', pr.last_name) ilike '%$value%'");
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
                $query->orderByDesc('pr.rate');
            }
        }
        $query->orderByDesc('users.created_at');

        $doctors = $query->paginate(10);

        $countAll = User::doctor()->count();
        $countCurrent = count($doctors);

        $regions = Region::where('parent_id', null)->pluck('name_' . LanguageHelper::getCurrentLanguagePrefix(), 'id');
        $clinics = Clinic::pluck('name_' . LanguageHelper::getCurrentLanguagePrefix(), 'id');
        $specializations = Specialization::pluck('name_' . LanguageHelper::getCurrentLanguagePrefix(), 'id');

        return view('doctors.index', compact('doctors', 'regions', 'clinics', 'specializations', 'countAll', 'countCurrent'));
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

        $ratecheck = Rate::where(['user_id'=>Auth::id(),'doctor_id'=>$user->id])->first();
        $rates = array();
        for ($i=5; $i > 0 ; $i--) { 
            array_push($rates, Rate::where(['doctor_id'=>$user->id,'rate'=>$i])->count());
        }
        return view('doctors.show', compact('user', 'clinics', 'specs', 'doctorTimetables', 'doctorBooks', 'holidays','ratecheck','rates'));
    }

}
