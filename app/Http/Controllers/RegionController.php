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

            $regions = Region::where('name_uz', 'LIKE', '%' . $request->search . '%')
                ->orWhere('name_ru', 'LIKE', '%' . $request->search . '%')
                ->orderBy('regions.id', 'asc')
                ->get();
            return view('regions.index', compact('regions'));

        }

        $regions = Region::orderBy('regions.id', 'asc')
            ->paginate(1000000);
        return view('regions.index', compact('regions'));


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
        return view('regions.createCity');
    }
    public function createDistrict()
    {
        return view('regions.createDistrict');
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
        $regions->parent_id = 0;
        $regions->name_uz = $request->region_uz;
        $regions->name_ru = $request->region_ru;
        $regions->save();

        $cities = new Region();
        $cities->parent_id = $regions->id;
        $cities->name_uz = $request->city_uz;
        $cities->name_ru = $request->city_ru;
        $cities->save();

        $districts = new Region();
        $districts->parent_id = $cities->id;
        $districts->name_uz = $request->district_uz;
        $districts->name_ru = $request->district_ru;
        $districts->save();

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
        $regions->name_uz = $request->name_uz;
        $regions->name_ru = $request->name_ru;
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
        $regions->delete();
        return redirect()->route('region.index')->with('success',  'Удалено!');
    }
}
