<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegionRequest;
use App\Entity\Region;
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
        $query = Region::orderByDesc('regions.id');

        if (!empty($value = $request->get('search'))) {
            $query->where(function ($query) use ($value) {
                $query->where('name_uz', 'ilike', '%' . $value . '%')
                    ->orWhere('name_ru', 'ilike', '%' . $value . '%');
            });
        }

        $categories = Region::where('parent_id', null);

        $regions = $query->paginate(20);
        return view('admin.regions.index', compact('regions', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $parents = Region::where('parent_id', null)->pluck('name_ru', 'id');
        return view('admin.regions.create', compact('parents'));
    }

    public function createCity()
    {
        $categories = Region::where('parent_id', null);
        return view('admin.regions.createCity', compact('categories'));
    }

    public function createDistrict()
    {
        $categories = Region::where('parent_id', null);
        return view('admin.regions.createDistrict', compact('categories'));
    }


    public function findCity($id)
    {
        $city = Region::where('parent_id', $id)->pluck('name_ru', 'id');
        return json_encode($city);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function store(RegionRequest $request)
    {
        dd($request->all());

        $regions = new Region();


        $regions->parent_id = $request->region;
        $regions->name_uz = $request->region_uz;
        $regions->name_ru = $request->region_ru;
        $regions->save();


        return redirect()->route('admin.region.index')->with('success', 'Успешно!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Region $region)
    {
        $categories = Region::where('parent_id', null);
        $regions = Region::find($region->id);
        return view('admin.regions.edit', compact('regions', 'categories'));
    }

    public function editCity(Region $region)
    {
        $categories = Region::where('parent_id', null);
        $regions = Region::find($region->id);
        return view('admin.regions.editCity', compact('regions', 'categories'));
    }

    public function editDistrict(Region $region)
    {
        $reg=Region::all();
        $categories = Region::where('parent_id', null);
        $regions = Region::find($region->id);
        return view('admin.regions.editDistrict', compact('regions', 'categories', 'reg'));
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

        $regions->parent_id = $request->region;
        $regions->name_uz = $request->region_uz;
        $regions->name_ru = $request->region_ru;
        $regions->update();
        $id = $regions->id;

        return redirect()->route('admin.region.index', compact('id'))->with('success', 'Отредактировано!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Region $region)
    {
        $regions = Region::find($region->id);
        $all = Region::all();
        foreach ($all as $a) {
            if ($regions->id == $a->parent_id) {
                return redirect()->route('admin.region.index')->with('dangerous', 'Нельзя удалить!');
            }
        }

        $regions->delete();
        return redirect()->route('admin.region.index')->with('success', 'Удалено!');
    }
}
