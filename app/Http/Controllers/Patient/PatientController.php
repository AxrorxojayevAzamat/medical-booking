<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entity\User\User;
use App\Entity\Clinic\Clinic;
use App\Entity\Book\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Hash;   
class PatientController extends Controller
{

    public function profileShow(User $user)
    {
        $user = User::find(Auth::user()->id);
        $book_num = count(Book::where('user_id', $user->id)->get());
        return view('patient.profile.index', compact('user','book_num'));
    }

    public function profileEdit(User $user)
    {
        $user = User::find(Auth::user()->id);
        $book_num = count(Book::where('user_id', $user->id)->get());
        return view('patient.profile.edit', compact('user','book_num'));
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

    public function myBookings($user_id)
    {
        $user = User::find(Auth::user()->id);
        $bookings = Book::where('user_id', $user_id)->get();
        $book_num = count(Book::where('user_id', $user->id)->get());
        return view('patient.patient_bookings', compact('bookings','user','payment_type','book_num'));
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
