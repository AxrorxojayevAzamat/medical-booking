<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entity\User\User;
use App\Entity\Clinic\Clinic;
use App\Entity\Book\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PatientController extends Controller
{

    public function profileShow(User $user)
    {
        $bookings = User::find(Auth::user()->id);
        return view('patient.profile', compact('bookings'));
    }

    public function myBookings($user_id)
    {

        $bookings = Book::where('user_id', $user_id)->get();


        return view('patient.patient_bookings', compact('bookings'));
    }

    public function booking(User $user, Clinic $clinic, Request $request)
    {

        if (!Gate::allows('patient-panel')) {
            return abort(401);
        }

        $calendar = $request['calendar'];
        $radioTime = $request['radio_time'];
        $price = config('booking_price.booking_price');
        $currency = config('booking_price.default_currency');

        $patient = User::find(Auth::user()->id);
        return view('patient.booking', compact('patient', 'user', 'clinic', 'calendar', 'radioTime', 'price', 'currency'));
    }

    public function bookingDoctor(Request $request)
    {
        $userId = $request['patient_id'];
        $doctorId = $request['doctor_id'];
        $clinicId = $request['clinic_id'];
        $bookingDate = $request['booking_date'];
        $timeStart = $request['time_start'];
        $description = $request['description'];


        $booking = Book::new($userId, $doctorId, $clinicId, $bookingDate, $timeStart, null, $description);


        return redirect()->route('doctors.index');
    }

}
