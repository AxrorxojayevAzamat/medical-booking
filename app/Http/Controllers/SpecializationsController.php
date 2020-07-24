<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entity\Clinic\Specialization;

class SpecializationsController extends Controller
{
    public function index()
    {
    	if(session('locale')=='uz')
    		$lang = 'name_uz';
    	else
    		$lang = 'name_ru';
    	
    	
    	$specializations = Specialization::orderBy($lang)->get();
        return view('specialization.index',compact('specializations','lang'));
    }
}
