<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entity\User\User;
use App\Entity\Clinic\Clinic;
use App\Entity\Book\Book;

class PatientController extends Controller {

    public function booking(User $user, Clinic $clinic, Request $request) {
        $calendar = $request['calendar'];
        $radioTime = $request['radio_time'];

        $patient = User::find(Auth()->id())->first();
        return view('patient.booking', compact('patient', 'user', 'clinic', 'calendar', 'radioTime'));
    }

    public function bookingDoctor(Request $request) {
        $user = User::newGuest(
                        $request['first_name'],
                        $request['last_name'],
                        $request['middle_name'],
                        $request['phone'],
                        $request['birth_date'],
                        $request['gender'],
                        $request['email']
        );
        $doctorId = $request['doctor_id'];
        $clinicId = $request['clinic_id'];
        $bookingDate = $request['booking_date'];
        $timeStart = $request['time_start'];
        $description = $request['description'];


        $booking = Book::new($user->id, $doctorId, $clinicId, $bookingDate, $timeStart, null, $description);


        return redirect()->route('book.index');
    }

}
