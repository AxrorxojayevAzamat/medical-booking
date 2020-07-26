<?php

namespace App\Http\Controllers\Admin\Clinic;

use App\Http\Controllers\Controller;
use App\Entity\Clinic\Clinic;
use App\Http\Requests\ClinicRequest;
use App\Entity\Region;
use App\Services\ClinicService;
use Illuminate\Http\Request;
use App\Traits\UploadTrait;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Entity\Clinic\AdminClinic;

class ClinicController extends Controller
{

    use UploadTrait;

    private $service;

    public function __construct(ClinicService $service)
    {
//        $this->middleware('can:manage-clinics');
        $this->middleware('can:admin-clinic-panel');
        $this->service = $service;
    }

    public function index(Request $request)
    {
        
        
        $query = Clinic::orderBy('id');
        $user = Auth::user();
//        dd($user->isClinic());
        if ($user->isClinic()) {
            $query = Clinic::forUser(Auth::user());
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
        $clinics = $query->paginate(10);
        return view('admin.clinics.index', compact('clinics'));
    }

    public function create()
    {
        $user = Auth::user();
        $adminClinic = AdminClinic::where('admin_id',$user->id)->first();
//        dd($adminClinic);
        if (!Gate::allows('manage-own-clinics', $adminClinic)) {
            abort(403);
        }
        $regions = Region::all();
        return view('admin.clinics.create', compact('regions'));
    }

    public function store(ClinicRequest $request)
    {
        try {
            $clinics = Clinic::create([
                        'name_uz' => $request->name_uz,
                        'name_ru' => $request->name_ru,
                        'region_id' => $request->region_id,
                        'type' => $request->clinic_type,
                        'description_uz' => $request->description_uz,
                        'description_ru' => $request->description_ru,
                        'phone_numbers' => $request->phone_numbers,
                        'address_uz' => $request->adress_uz,
                        'address_ru' => $request->adress_ru,
                        'work_time_start' => $request->work_time_start,
                        'work_time_end' => $request->work_time_end,
                        'location' => $request->location,
            ]);
            return redirect()->route('admin.clinics.index', $clinics);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }


        // $folder = Clinic::CLINIC_PROFILE;
        // $photos = $request->file('images');
        // if ($request->hasFile('images')) {
        //     foreach ($photos as $photo) {
        //         $this->deleteOne($folder, 'public', $clinics->photo);
        //         $filename = uniqid() . '_' . trim($photo->getClientOriginalName());
        //         $this->uploadOne($photo, $folder, 'public', $filename);
        //         $filePath = $filename;
        //         $data[] = $filePath;
        //     }
        // }
        // $clinics->photo = json_encode($data);
    }

    public function show(Clinic $clinic)
    {
        $contacts = $clinic->contacts()->orderBy('type')->get();
        return view('admin.clinics.show', compact('clinic', 'contacts'));
    }

    public function edit(Clinic $clinic)
    {
        $clinics = Clinic::find($clinic->id);
        $regions = Region::all();
        return view('admin.clinics.edit', compact('clinics', 'regions'));
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


//        if ($request->hasfile('photo')) {
//
//            foreach ($request->file('photo') as $p) {
//
//                $filename = Str::slug($clinics->name_ru) . '_' . time();
//                $p->move(public_path() . '/uploads/photo_clinics', $filename);
//                $filePath = $filename . '.' . $p->getClientOriginalExtension();
//                $clinics->photo = json_encode($filePath);
//            }
//        }

        $folder = Clinic::CLINIC_PROFILE;
        $images = $request->file('images');
        if ($request->hasfile('images')) {
            foreach ($images as $image) {
                $filename = Str::slug($clinics->name_ru) . '_' . time();
                $this->uploadOne($image, $folder, 'public', $filename);
                $filePath[] = $filename . '.' . $image->getClientOriginalExtension();
            }
            $clinics->photo = json_encode($filePath);
        }


        $clinics->update();
        $id = $clinics->id;

        return redirect()->route('admin.clinics.index', compact('id'))->with('success', 'Отредактировано!');
    }

    public function destroy(Clinic $clinic)
    {
        $folder = Clinic::CLINIC_PROFILE;
        $clinics = Clinic::find($clinic->id);
        $photos = json_decode($clinics->photo);
        // foreach ($photos as $photo) {
        //     $this->deleteOne($folder, 'public', $photo);
        // }
        $clinics->delete();
        return redirect()->back();
        // return redirect()->route('admin.clinic.index')->with('success', 'Удалено!');
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

}
