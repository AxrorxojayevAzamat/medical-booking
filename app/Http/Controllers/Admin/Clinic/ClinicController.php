<?php

namespace App\Http\Controllers\Admin\Clinic;

use App\Entity\Clinic\Service;
use App\Entity\Region;
use App\Entity\Clinic\Photo;
use Illuminate\Http\Request;
use App\Entity\Clinic\Clinic;
use App\Services\ClinicService;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClinicRequest;
use Illuminate\Support\Facades\Auth;
use App\Entity\Clinic\AdminClinic;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ClinicController extends Controller
{

    private $service;

    public function __construct(ClinicService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {

        $query = Clinic::orderBy('id');
        $userAuth = Auth::user();
        if (Gate::allows('admin-clinic-panel')) {
            $query = Clinic::forUser($userAuth);
        }

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
        $clinics = $query->paginate(30);
        return view('admin.clinics.index', compact('clinics'));
    }

    public function create()
    {
        $this->middleware('manage-clinics');
        $parentRegions = Region::where('parent_id', null)->pluck('name_ru', 'id');
        $services = Service::orderByDesc('name_ru')->pluck('name_ru', 'id')->toArray();

        return view('admin.clinics.create', compact('regions', 'services', 'parentRegions'));
    }

    public function store(ClinicRequest $request)
    {
        try {
            $clinic = $this->service->create($request);

            return redirect()->route('admin.clinics.show', $clinic);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function show(Clinic $clinic)
    {
        $this->checkAccess($clinic);
        $contacts = $clinic->contacts()->orderBy('type')->get();
        return view('admin.clinics.show', compact('clinic', 'contacts'));
    }

    public function edit(Clinic $clinic)
    {
        $this->checkAccess($clinic);
        $regions = Region::all();

        $parentRegions = [];
        $parent = $clinic->region;
        while ($parent) {
            $parentRegions[] = $parent;
            $parent = $parent->parent;
        }
        $parentRegions = array_reverse($parentRegions);

        $services = Service::orderByDesc('name_ru')->pluck('name_ru', 'id')->toArray();

        return view('admin.clinics.edit', compact('clinic', 'regions', 'services', 'parentRegions'));
    }

    public function update(ClinicRequest $request, $id)
    {
        try {
            $clinic = $this->service->update($id, $request);
            return redirect()->route('admin.clinics.show', $clinic)->with('success', 'Успешно!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Clinic $clinic)
    {
        $this->checkAccess($clinic);

        $photos = $this->service->deleteAllPhotos($clinic);
        if ($photos == true) {
            $clinic->delete();
        } else {
            $clinic->delete();
        }
        return redirect()->route('admin.clinics.index')->with('success', 'Успешно удалено!');
    }

    public function mainPhoto(Clinic $clinic)
    {
        $this->checkAccess($clinic);
        return view('admin.clinics.add-main-photo', compact('clinic'));
    }

    public function removeMainPhoto(Clinic $clinic)
    {
        $this->checkAccess($clinic);
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
        $this->checkAccess($clinic);
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
            return redirect()->route('admin.clinics.photos', $clinic)->with('success', 'Успешно удалено!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function movePhotoUp(Clinic $clinic, Photo $photo)
    {
        $this->checkAccess($clinic);
        try {
            $this->service->movePhotoUp($clinic->id, $photo->id);
            return back();
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function movePhotoDown(Clinic $clinic, Photo $photo)
    {
        $this->checkAccess($clinic);
        try {
            $this->service->movePhotoDown($clinic->id, $photo->id);
            return back();
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    private function checkAccess(Clinic $clinic): void
    {
        if (!Gate::allows('manage-own-clinics', $clinic)) {
            abort(403);
        }
    }
}
