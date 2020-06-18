<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Clinic;
use App\Http\Requests\ClinicRequest;
use App\Region;
use App\Services\ClinicService;
use Illuminate\Http\Request;
use App\Traits\UploadTrait;
use Illuminate\Support\Str;

class ClinicController extends Controller
{
    use UploadTrait;

    private $service;

    public function __construct(ClinicService $service)
    {
        $this->service = $service;
    }
    /**
     * Show the form for indexing a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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
        try {
            $clinics = $this->service->create($request);
            return redirect()->route('admin.clinic.index')->with('success', 'Успешно!');
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
        $clinics->phone_numbers = $request->phone_numbers;
        $clinics->adress_uz = $request->adress_uz;
        $clinics->adress_ru = $request->adress_ru;
        $clinics->work_time_start = $request->work_time_start;
        $clinics->work_time_end = $request->work_time_end;
        $clinics->location = $request->location;


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
        $clinics->save();
    }

    public function show(Clinic $clinic)
    {
        $clinic = Clinic::find($clinic->id);
        $clinics = Clinic::all();
        $regions = Region::all();
        return view('admin.clinics.show', compact('clinic', 'regions', 'clinics'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Clinic $clinic)
    {
        $clinics = Clinic::find($clinic->id);
        $regions = Region::all();
        return view('admin.clinics.edit', compact('clinics', 'regions'));
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

        return redirect()->route('admin.clinic.index', compact('id'))->with('success', 'Отредактировано!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Clinic $clinic)
    {
        $folder = Clinic::CLINIC_PROFILE;
        $clinics = Clinic::find($clinic->id);
        $photos = json_decode($clinics->photo);
        // foreach ($photos as $photo) {
        //     $this->deleteOne($folder, 'public', $photo);
        // }
        $clinics->delete();

        return redirect()->route('admin.clinic.index')->with('success', 'Удалено!');
    }

    public function mainPhoto(Clinic $clinic)
    {
        return view('admin.clinics.add-main-photo', compact('clinic'));
    }
}