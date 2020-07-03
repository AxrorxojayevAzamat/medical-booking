<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entity\User\User;
use App\Entity\Clinic\Timetable;
use App\Entity\Celebration;
use App\Entity\Book\Book;
use App\Entity\Clinic\Clinic;
use App\Entity\Clinic\DoctorClinic;
use App\Entity\Clinic\DoctorSpecialization;
use App\UseCases\Book\BookService;
use Carbon\Carbon;

class BookController extends Controller {

    private $service;

    public function __construct(BookService $service) {
        $this->service = $service;
    }

    public function index(Request $request) {
        $query = User::select(['users.*', 'pr.*'])
                ->leftJoin('profiles as pr', 'users.id', '=', 'pr.user_id')
                ->join('timetables as ts', 'users.id', '=', 'ts.doctor_id')
                ->join('doctor_clinics as dc', 'users.id', '=', 'dc.doctor_id')
                ->join('doctor_specializations as ds', 'users.id', '=', 'ds.doctor_id')
                ->where('role', User::ROLE_DOCTOR)
                ->groupBy(['users.id', 'pr.user_id'])
                ->orderByDesc('users.created_at');
        $doctors = $query->paginate(10);

        return view('book.index', compact('doctors'));
    }

    public function show(User $user) {
        $clinics = $user->clinics;
        $clinic2 = $user->clinics->pluck('id')->toArray();
        $specs = $user->specializations;

        $currentDate = Carbon::now()->format('Y-m-d');

        $doctorTimetables = Timetable::where('doctor_id', $user->id)
                ->whereIn('clinic_id', $clinic2)
                ->get();

        $celebrationDays = Celebration::orderByDesc('id')->get();

        $doctorBooks = Book::where('doctor_id', $user->id)
                        ->whereIn('clinic_id', $clinic2)->get();


        $daysOff0 = array();
        $daysOff = array();
        $timeSlots = array();
        $holidays = array();
        foreach ($doctorTimetables as $timetable) {
            $start = Carbon::now()->startOfMonth();
            $end = Carbon::now()->endOfMonth();
            $restStart = Carbon::createFromFormat('Y-m-d', $timetable->day_off_start);
            $restEnd = Carbon::createFromFormat('Y-m-d', $timetable->day_off_end);

            if ($timetable->isWeek()) {
                $docDayOfWeeks = $this->service->getDaysConst($timetable);
                $daysOff1 = $this->service->daysDisabled($docDayOfWeeks, $start, $end);
            } else {

                if ($timetable->isOdd())
                    $daysOff1 = $this->service->daysDisabledBool(false, $start, $end); //false -- odd ; true -- even
                else
                    $daysOff1 = $this->service->daysDisabledB(true, $start, $end);
            }

            $holidays = $this->service->celebrationDays($celebrationDays);
            $daysOff3 = $this->service->restDays($restStart, $restEnd);

            if (!empty($holidays)) {
                $daysOff0 = array_unique(array_merge($daysOff1, $holidays, $daysOff3));
            } else {
                $daysOff0 = array_unique(array_merge($daysOff1, $daysOff3));
            }
            array_push($timeSlots, ['clinic_id' => $timetable->clinic_id, 'time_slots' => $this->service->timeSlots($timetable, $currentDate)]);
            array_push($daysOff, ['clinic_id' => $timetable->clinic_id, 'days_off' => $daysOff0]);
        }

        return view('book.show', compact('user', 'clinics', 'specs', 'daysOff', 'timeSlots', 'doctorTimetables', 'doctorBooks', 'holidays'));
    }

}
