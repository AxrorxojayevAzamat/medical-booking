<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegionRequest;
use App\Region;
use Illuminate\Http\Request;


class RegionController extends Controller
{
    /**
     * Show the form for indexing a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if ($request->search) {
            $categories=Region::children(null);
            $regions = Region::orderBy('id', 'DESC')
            ->where('name_uz', 'ILIKE', '%' . $request->search . '%')
                ->orWhere('name_ru', 'ILIKE', '%' . $request->search . '%')
                ->get();
            return view('regions.index', compact('regions','categories'));

        }


        $categories=Region::children(null);
        $regions = Region::orderBy('regions.id', 'asc')
            ->paginate(1000000);
        return view('regions.index', compact('regions','categories'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('regions.create');
    }
    public function createCity()
    {
        $categories=Region::children(null);
        return view('regions.createCity',compact('categories'));
    }
    public function createDistrict()
    {

        $categories=Region::children(null);
        return view('regions.createDistrict',compact('categories'));
    }


    public function findCity($id){

        $city=Region::where('parent_id',$id)->pluck('name_ru','id');
        return json_encode($city);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RegionRequest $request)
    {
        $regions = new Region();
        $regions->parent_id = $request->region;
        $regions->name_uz = $request->region_uz;
        $regions->name_ru = $request->region_ru;
        $regions->save();

        return redirect()->route('region.index')->with('success', 'Успешно!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $regions = Region::find($id);
        return view('regions.edit', compact('regions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(RegionRequest $request, $id)
    {

        $regions = Region::find($id);
        $regions->name_uz = $request->region_uz;
        $regions->name_ru = $request->region_ru;
        $regions->update();
        $id = $regions->id;

        return redirect()->route('region.index', compact('id'))->with('success', 'Отредактировано!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $regions = Region::find($id);
        $all=Region::all();
        foreach ($all as $a)
        {
            if ($regions->id == $a->parent_id)
                return redirect()->route('region.index')->with('dangerous', 'Нельзя удалить!');
        }

        $regions->delete();
        return redirect()->route('region.index')->with('success', 'Удалено!');
    }
}
