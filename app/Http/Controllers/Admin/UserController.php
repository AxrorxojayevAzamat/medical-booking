<?php

namespace App\Http\Controllers\Admin;

use App\Entity\User\User;
use App\Entity\User\Photo;
use Illuminate\Support\Str;
use App\Entity\User\Profile;
use Illuminate\Http\Request;
use App\Entity\Clinic\Clinic;
use App\Services\UserService;
use App\Entity\Clinic\Timetable;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Entity\Clinic\Specialization;
use App\Http\Requests\Admin\Users\CreateRequest;
use App\Http\Requests\Admin\Users\UpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{

    private $service;

    public function __construct(UserService $service)
    {
//        $this->middleware('can:manage-users');
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $users = $this->service->search($request)->paginate(20);

        $roles = User::rolesList();

        $statuses = User::statusList();

        return view('admin.users.index', compact('users', 'roles', 'statuses'));
    }

    public function create()
    {
        $this->middleware('can:manage-users');
        $roles = User::rolesList();
        $statuses = User::statusList();
        return view('admin.users.create', compact('roles', 'statuses'));
    }

    public function store(CreateRequest $request)
    {
        try {
            $user = $this->service->create($request);
            return redirect()->route('admin.users.show', $user);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function show(User $user)
    {
        $this->checkAccess($user);

        $profile = $user->profile;
        $specializations = Specialization::orderBy('name_ru')->pluck('name_ru', 'id');
        $clinics = Clinic::orderBy('name_ru')->pluck('name_ru', 'id');
        $doctor = User::find($user->id);
        $timetable = Timetable::where('doctor_id', $user->id)->get();

        return view('admin.users.show', compact('user', 'profile', 'specializations', 'doctor', 'clinics', 'timetable'));
    }

    public function edit(User $user)
    {
        $this->checkAccess($user);

        $roles = User::rolesList();
        $specializations = Specialization::orderBy('name_ru')->pluck('name_ru', 'id');
        $clinics = Clinic::orderBy('name_ru')->get();
        $doctor = User::find($user->id);
        $statuses = User::statusList();
        $timetable = Timetable::where('doctor_id', $user->id)->get();
        $profile = $user->profile;
        return view('admin.users.edit', compact('user', 'profile', 'roles', 'specializations', 'doctor', 'statuses', 'clinics', 'timetable'));
    }

    public function update(UpdateRequest $request, User $user)
    {
        try {
            $user = $this->service->update($request, $user);
            return redirect()->route('admin.users.show', $user);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy(User $user)
    {
        $photos = $this->service->deleteAllPhotos($user);
        if ($photos == true) {
            $user->delete();
        }


        return redirect()->route('admin.users.index');
    }

    public function storeSpecializations(Request $request, User $user)
    {
        $user->specializations()->sync($request['specializationUser']);

        return redirect()->route('admin.users.show', $user);
    }

    public function specializations(User $user)
    {
        $this->checkAccess($user);

        $specializations = Specialization::orderBy('name_ru')->pluck('name_ru', 'id');

        return view('admin.users.specializations', compact('user', 'specializations'));
    }

    public function storeClinics(Request $request, User $user)
    {
        $user->clinics()->sync($request['clinicUser']);

        return redirect()->route('admin.users.show', $user);
    }

    public function userClinics(User $user)
    {
        $this->checkAccess($user);

        $clinics = Clinic::orderBy('name_ru')->pluck('name_ru', 'id');
        return view('admin.users.clinics', compact('user', 'clinics'));
    }

    public function storeAdminClinics(Request $request, User $user)
    {
        $user->adminsClinics()->sync($request['clinicAdmin']);

        return redirect()->route('admin.users.show', $user);
    }

    public function adminClinics(User $user)
    {
        $clinics = Clinic::orderBy('name_ru')->pluck('name_ru', 'id');
        return view('admin.users.admin-clinics', compact('user', 'clinics'));
    }

    public function mainPhoto(User $user)
    {
        $this->checkAccess($user);
        $profile = Profile::find($user->id);
        return view('admin.users.add-main-photo', compact('profile'));
    }

    public function addMainPhoto(User $user, Request $request)
    {
        try {
            $this->validate($request, ['photo' => 'required|image|mimes:jpg,jpeg,png']);
            $this->service->addMainPhoto($user->id, $request->photo);

            return redirect()->route('admin.users.show', $user)->with('success', 'Успешно сохранено!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function removeMainPhoto(User $user)
    {
        try {
            $this->service->removeMainPhoto($user->id);
            return response()->json('The main photo is successfully deleted!');
        } catch (\Exception $e) {
            return response()->json('The main photo is not deleted!', 400);
        }
    }

    public function photos(User $user)
    {
        $this->checkAccess($user);
        $profile = Profile::findorFail($user->id);
        return view('admin.users.add-photo', compact('profile'));
    }

    public function addPhoto(User $user, Request $request)
    {
        $profile = Profile::findorFail($user->id);
        try {
            $this->validate($request, ['photo' => 'required|image|mimes:jpg,jpeg,png']);
            $this->service->addPhoto($profile->user_id, $request->photo);
            session()->flash('message', 'asd');
            return back();
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function removePhoto(User $user, Photo $photo)
    {
        $profile = Profile::findorFail($user->id);
        try {
            $this->service->removePhoto($profile->user_id, $photo->id);
            return redirect()->route('admin.users.photos', $profile)->with('success', 'Успешно удалено!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function movePhotoUp(User $user, Photo $photo)
    {
        $this->checkAccess($user);
        $profile = Profile::findorFail($user->id);
        try {
            $this->service->movePhotoUp($profile->user_id, $photo->id);
            return back();
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function movePhotoDown(User $user, Photo $photo)
    {
        $this->checkAccess($user);
        $profile = Profile::findorFail($user->id);
        try {
            $this->service->movePhotoDown($profile->user_id, $photo->id);
            return back();
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function multiplePhotoDelete($clinic)
    {
        $photos = $clinic->photos;
        try {
            foreach ($photos as $i => $photo) {
                $this->removePhoto($clinic->id, $photo->id);
            }
            return true;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    private function checkAccess(User $user): void
    {
//        if (!Gate::allows('manage-own-doctors', $user)) {
//            abort(403);
//        } else 
            if (!Gate::allows('manage-doctors', $user)) {
            abort(403);
        }
    }

}
