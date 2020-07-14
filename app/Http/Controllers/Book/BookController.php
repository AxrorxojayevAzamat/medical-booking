<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entity\User\User;
use App\Entity\Clinic\Timetable;
use App\Entity\Celebration;
use App\Entity\Book\Book;
use App\Entity\Clinic\Clinic;
use App\Services\BookService;
use Carbon\Carbon;

class BookController extends Controller {

    private $service;

    public function __construct(BookService $service) {
        $this->service = $service;
    }

    public function index(Request $request) {

        $doctors = $this->doctors($request);

        return view('book.index', compact('doctors'));
    }

    public function show(User $user) {
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

        return view('book.show', compact('user', 'clinics', 'specs', 'doctorTimetables', 'doctorBooks', 'holidays'));
    }

    public function doctors(Request $request) {
        $query = User::select(['users.*', 'pr.*'])
                ->leftJoin('profiles as pr', 'users.id', '=', 'pr.user_id')
                ->join('timetables as ts', 'users.id', '=', 'ts.doctor_id')
                ->join('doctor_clinics as dc', 'users.id', '=', 'dc.doctor_id')
                ->join('doctor_specializations as ds', 'users.id', '=', 'ds.doctor_id')
                ->where('role', User::ROLE_DOCTOR)
                ->groupBy(['users.id', 'pr.user_id'])
                ->orderByDesc('users.created_at');
        $doctors = $query->paginate(10);

        return $doctors;
    }

    public function review(User $user) {

        return view('book.review');
    }

}
