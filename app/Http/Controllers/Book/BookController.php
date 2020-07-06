<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entity\User\User;
use App\Entity\Clinic\Timetable;
use App\Entity\Celebration;
use App\Entity\Book\Book;
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
                ->where('role', User::ROLE_DOCTOR)
                ->orderByDesc('created_at');
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
        foreach ($doctorTimetables as $timetable) {
            $start = Carbon::now()->startOfMonth();
            $end = Carbon::now()->endOfMonth();
            $restStart = Carbon::createFromFormat('Y-m-d', $timetable->day_off_start);
            $restEnd = Carbon::createFromFormat('Y-m-d', $timetable->day_off_end);

            $docDayOfWeeks = $this->service->getDaysConst($timetable);

            $daysOff1 = $this->service->daysDisabled($docDayOfWeeks, $start, $end);
            $daysOff2 = $this->service->celebrationDays($celebrationDays);
            $daysOff3 = $this->service->restDays($restStart, $restEnd);

            if (!empty($daysOff2)) {
                $daysOff0 = array_merge($daysOff1, $daysOff2, $daysOff3);
            } else {
                $daysOff0 = array_merge($daysOff1, $daysOff3);
            }
            array_push($timeSlots, ['clinic_id' => $timetable->clinic_id, 'time_slots' => $this->service->timeSlots($timetable, $currentDate)]);
            array_push($daysOff, ['clinic_id' => $timetable->clinic_id, 'days_off' => $daysOff0]);
        }


        return view('book.show', compact('user', 'clinics', 'specs', 'daysOff', 'timeSlots', 'doctorTimetables', 'doctorBooks'));
    }

}