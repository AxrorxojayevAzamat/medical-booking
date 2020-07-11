<?php

namespace App\Http\Controllers\Doctor;

use App\Entity\Book\Book;
use App\Entity\User\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller {


    public function profileShow() {
        $bookings = User::find(Auth::user()->id);
        return view('doctor.profile', compact('bookings'));
    }


    public function doctorBookings($doctor_id){

        $bookings = Book::where('doctor_id', $doctor_id)->get();


        return view('doctor.doctor_bookings', compact('bookings'));

    }
}
