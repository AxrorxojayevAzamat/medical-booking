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

}
