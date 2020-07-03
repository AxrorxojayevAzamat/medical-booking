<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entity\User\User;
use App\Entity\Clinic\Clinic;
use App\Entity\Book\Book;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller {

    public function booking(User $user, Clinic $clinic, Request $request) {
        $calendar = $request['calendar0'];
        $radioTime = $request['radio_time'];

        $patient = User::find(Auth::user()->id);
        return view('patient.booking', compact('patient', 'user', 'clinic', 'calendar', 'radioTime'));
    }

    public function bookingDoctor(Request $request) {
        $userId = $request['patient_id'];
        $doctorId = $request['doctor_id'];
        $clinicId = $request['clinic_id'];
        $bookingDate = $request['booking_date'];
        $timeStart = $request['time_start'];
        $description = $request['description'];


        $booking = Book::new($userId, $doctorId, $clinicId, $bookingDate, $timeStart, null, $description);


        return redirect()->route('book.index');
    }

}
