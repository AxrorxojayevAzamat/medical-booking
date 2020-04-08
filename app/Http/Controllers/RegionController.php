<?php

namespace App\Http\Controllers;

use App\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{

    public  function index(){
        $regions=Region::all();
        return view('regions.index',compact('regions'));
    }

    public function create(){
        return view('regions.create');
    }

    public function store(Request $request){
        $regions=new Region();
        $regions->name_uz = $request->name_uz;
        $regions->name_ru = $request->name_ru;
        $regions->parent_id=null;
        $regions->save();
        return redirect()->route('regions.index');
    }

    public function show($id){
        $regions = Region::find($id);
        return view('regions.show', compact('regions'));
    }

    public function edit($id){
        $regions = Region::find($id);
        return view('regions.edit', compact('regions'));
    }

    public function update(Request $request, $id){
        $regions = Region::find($id);
        $regions->name_uz = $request->name_uz;
        $regions->name_ru = $request->name_ru;
        $regions->update();
        $id = $regions->id;
        return redirect()->route('regions.show', compact('id'));
    }

    public function destroy($id){
        $regions = Region::find($id);
        $regions->delete();
        return redirect()->route('regions.index');
    }
}
