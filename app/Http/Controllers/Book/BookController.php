<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entity\User\User;
use App\Entity\Clinic\Timetable;
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
        $clinic = $user->clinics;
        $spec = $user->specializations;

//        $currentDate = Carbon::now()->format('Y-m-d');
//
//        $doctorTimetable = Timetable::where('doctor_id', $user->id)
//                ->where('clinic_id', $clinic->id)
//                ->first();
//
//        $celebrationDays = Celebration::orderByDesc('id')->get();
//
//        $doctorBooks = Book::where('doctor_id', $user1->id)
//                        ->where('clinic_id', $clinic1->id)->get();
//
//        $start = Carbon::now()->startOfMonth();
//        $end = Carbon::now()->endOfMonth();
//        $restStart = Carbon::createFromFormat('Y-m-d', $doctorTimetable->day_off_start);
//        $restEnd = Carbon::createFromFormat('Y-m-d', $doctorTimetable->day_off_end);
//
//        $docDayOfWeeks = $this->service->getDaysConst($doctorTimetable);
//
//        $daysOff = array();
//        $daysOff1 = $this->service->daysDisabled($docDayOfWeeks, $start, $end);
//        $daysOff2 = $this->service->celebrationDays($celebrationDays);
//        $daysOff3 = $this->service->restDays($restStart, $restEnd);
//
//        $timeSlots = $this->service->timeSlots($doctorTimetable, $currentDate);
//
//
//        if (!empty($daysOff2)) {
//            $daysOff = array_merge($daysOff1, $daysOff2, $daysOff3);
//        } else {
//            $daysOff = array_merge($daysOff1, $daysOff3);
//        }
        return view('book.show', compact('user', 'clinic', 'spec'
//        'daysOff', 'timeSlots', 'doctorTimetable', 'doctorBooks'
        ));
    }

}