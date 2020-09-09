<?php

namespace App\Http\Controllers\Admin;

use App\Entity\User\User;
use Illuminate\Http\Request;
use App\Entity\Clinic\Clinic;
use App\Services\UserService;
use App\Entity\Clinic\Timetable;
use App\Http\Controllers\Controller;
use App\Entity\Clinic\Specialization;
use App\Http\Requests\Admin\Users\CreateRequest;
use App\Http\Requests\Admin\Users\UpdateRequest;
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

        return view('admin.users.index', compact('users'));
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
