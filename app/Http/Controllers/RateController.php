<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entity\Rate;
use App\Entity\User\Profile;
use Auth;

class RateController extends Controller
{
    public function rate(Request $request){
        
        
        if(!Auth::check()){
            return redirect()->intended('login');
        }

        if($request->rate<1 || $request->rate>5){
            return redirect()->back()->with('error', 'You are injecting code');      
        }

        $rates = Rate::create([
            'user_id'=>Auth::id(),
            'doctor_id'=>$request->doctor_id,
            'rate'=>$request->rate
        ]);

        $doctor = Profile::find($request->doctor_id);
        $doctor->rate += $request->rate;
        $doctor->num_of_rates++;
        $doctor->save();

        return redirect()->back()->with('success', 'Successfully Rated');   

    }

    public function rateCancel(Request $request){
        
        $user_rate = Rate::where(['user_id'=>Auth::id(),'doctor_id'=>$request->doctor_id])->first();
        if (!$user_rate) {
            return redirect()->back()->with('success', 'Your Rate Canceled');    
        }
        $doctor = Profile::find($request->doctor_id);
        $doctor->rate -= $user_rate->rate;
        $doctor->num_of_rates--;
        $doctor->save();
        
        $user_rate->delete();

        return redirect()->back()->with('success', 'Your Rate Canceled');   
    }
}
