<?php

namespace App\Http\Controllers\Admin\Clinic;

use App\Entity\Region;
use App\Entity\Clinic\Photo;
use Illuminate\Http\Request;
use App\Entity\Clinic\Clinic;
use App\Services\ClinicService;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClinicRequest;

class ClinicController extends Controller
{
    private $service;

    public function __construct(ClinicService $service)
    {
        $this->middleware('can:manage-clinics');
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $query = Clinic::orderBy('id');

        $this->validate($request, [
            'id' => ['integer', 'nullable'],
        ]);

        if (!empty($value = $request->get('searchclinic'))) {
            $query->where('name_uz', 'ILIKE', '%' . $value . '%')
                    ->orWhere('name_ru', 'ILIKE', '%' . $value . '%');
        }

        if (!empty($value = $request->get('typeClinic'))) {
            $query->where('type', $value);
        }
        $clinics = $query->paginate(1000);
        return view('admin.clinics.index', compact('clinics'));
    }

    public function create()
    {
        $regions = Region::all();
        return view('admin.clinics.create', compact('regions'));
    }

    public function store(ClinicRequest $request)
    {
        try {
            $clinics = $this->service->create($request);
            return redirect()->route('admin.clinics.index')->with('success', 'Успешно!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
        $clinics = new Clinic();
        $clinics->name_uz = $request->name_uz;
        $clinics->name_ru = $request->name_ru;
        $clinics->region_id = $request->region_id;
        $clinics->type = $request->type;
        $clinics->description_uz = $request->description_uz;
        $clinics->description_ru = $request->description_ru;
        $clinics->address_uz = $request->adress_uz;
        $clinics->address_ru = $request->adress_ru;
        $clinics->work_time_start = $request->work_time_start;
        $clinics->work_time_end = $request->work_time_end;
        $clinics->location = $request->location;

        $clinics->save();
    }

    public function show(Clinic $clinic)
    {
        $contacts = $clinic->contacts()->orderBy('type')->get();
        return view('admin.clinics.show', compact('clinic', 'contacts'));
    }

    public function edit(Clinic $clinic)
    {
        $clinic = Clinic::find($clinic->id);
        $regions = Region::all();
        return view('admin.clinics.edit', compact('clinic', 'regions'));
    }

    public function update(ClinicRequest $request, $id)
    {
        $clinics = Clinic::find($id);

        $clinics->name_uz = $request->name_uz;
        $clinics->name_ru = $request->name_ru;
        $clinics->region_id = $request->region_id;
        $clinics->type = $request->type;
        $clinics->description_uz = $request->description_uz;
        $clinics->description_ru = $request->description_ru;
        $clinics->address_uz = $request->address_uz;
        $clinics->address_ru = $request->address_ru;
        $clinics->work_time_start = $request->work_time_start;
        $clinics->work_time_end = $request->work_time_end;
        $clinics->location = $request->location;

        $clinics->update();
        $id = $clinics->id;

        return redirect()->route('admin.clinics.index', compact('id'))->with('success', 'Отредактировано!');
    }

    public function destroy(Clinic $clinic)
    {
        $clinics = Clinic::find($clinic->id);
        $clinics->delete();
        return redirect()->back();
    }

    public function mainPhoto(Clinic $clinic)
    {
        return view('admin.clinics.add-main-photo', compact('clinic'));
    }
    public function removeMainPhoto(Clinic $clinic)
    {
        try {
            $this->service->removeMainPhoto($clinic->id);
            return response()->json('The main photo is successfully deleted!');
        } catch (\Exception $e) {
            return response()->json('The main photo is not deleted!', 400);
        }
    }

    public function addMainPhoto(Clinic $clinic, Request $request)
    {
        try {
            $this->validate($request, ['photo' => 'required|image|mimes:jpg,jpeg,png']);
            $this->service->addMainPhoto($clinic->id, $request->photo);

            return redirect()->route('admin.clinics.show', $clinic)->with('success', 'Успешно сохранено!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    
    public function photos(Clinic $clinic)
    {
        return view('admin.clinics.add-photo', compact('clinic'));
    }

    public function addPhoto(Clinic $clinic, Request $request)
    {
        try {
            $this->validate($request, ['photo' => 'required|image|mimes:jpg,jpeg,png']);

            $this->service->addPhoto($clinic->id, $request->photo);
            // return redirect()->route('admin.clinics.add-photo', $clinic)->with('success', 'Успешно сохранено!');
            session()->flash('message', 'asd');
            return back();
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function removePhoto(Clinic $clinic, Photo $photo)
    {
        try {
            $this->service->removePhoto($clinic->id, $photo->id);
            return redirect()->route('admin.clinic.photos', $clinic)->with('success', 'Успешно удалено!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function movePhotoUp(Clinic $clinic, Photo $photo)
    {
        try {
            $this->service->movePhotoUp($clinic->id, $photo->id);
            return back();
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function movePhotoDown(Clinic $clinic, Photo $photo)
    {
        try {
            $this->service->movePhotoDown($clinic->id, $photo->id);
            return back();
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
