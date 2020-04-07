<?php

namespace App\Http\Controllers;

use App\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public  function index(){
        return view('regions.index');
    }

    public function store(Request $request){
        $regions=new Region();
        $regions->name_uz = $request->name_uz;
        $regions->name_ru = $request->name_ru;
        $regions->parent_id=null;
        $regions->save();
        return redirect()->route('regions.index');

    }
}
