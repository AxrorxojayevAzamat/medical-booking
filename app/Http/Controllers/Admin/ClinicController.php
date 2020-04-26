<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Clinic;
use App\Http\Requests\ClinicRequest;
use App\Region;
use Illuminate\Http\Request;

class ClinicController extends Controller
{
    /**
     * Show the form for indexing a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $clinics = Clinic::orderBy('clinics.id', 'asc')
            ->paginate(1000000);
        return view('admin.clinics.index', compact('clinics'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $regions = Region::all();
        return view('admin.clinics.create', compact('regions'));

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function store(ClinicRequest $request)
    {
        $clinics = new Clinic();
        $clinics->name_uz = $request->name_uz;
        $clinics->name_ru = $request->name_ru;
        $clinics->region_id = $request->region_id;
        $clinics->type = $request->type;
        $clinics->description_uz = $request->description_uz;
        $clinics->description_ru = $request->description_ru;
        $clinics->phone_numbers = $request->phone_numbers;
        $clinics->adress_uz = $request->adress_uz;
        $clinics->adress_ru = $request->adress_ru;
        $clinics->work_time = $request->work_time;
        $clinics->location = $request->location;
        $clinics->save();

        return redirect()->route('clinic.index')->with('success', 'Успешно!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $clinics = Clinic::find($id);
        $regions=Region::all();
        return view('admin.clinics.edit', compact('clinics','regions'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ClinicRequest $request, $id)
    {

        $clinics = Clinic::find($id);

        $clinics->name_uz = $request->name_uz;
        $clinics->name_ru = $request->name_ru;
        $clinics->region_id = $request->region_id;
        $clinics->type = $request->type;
        $clinics->description_uz = $request->description_uz;
        $clinics->description_ru = $request->description_ru;
        $clinics->phone_numbers = $request->phone_numbers;
        $clinics->adress_uz = $request->adress_uz;
        $clinics->adress_ru = $request->adress_ru;
        $clinics->work_time = $request->work_time;
        $clinics->location = $request->location;
        $clinics->update();
        $id = $clinics->id;

        return redirect()->route('clinic.index', compact('id'))->with('success', 'Отредактировано!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $clinics = Clinic::find($id);
        $clinics->delete();
        return redirect()->route('clinic.index')->with('success', 'Удалено!');
    }
}
