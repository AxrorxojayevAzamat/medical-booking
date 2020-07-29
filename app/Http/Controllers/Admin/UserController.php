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

class UserController extends Controller
{
    private $service;

    public function __construct(UserService $service)
    {
        $this->middleware('can:manage-users');
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
        $profile = $user->profile;
        $specializations = Specialization::orderBy('name_ru')->pluck('name_ru', 'id');
        $clinics = Clinic::orderBy('name_ru')->pluck('name_ru', 'id');
        $doctor = User::find($user->id);
        $timetable = Timetable::where('doctor_id', $user->id)->get();
        
        return view('admin.users.show', compact('user', 'profile', 'specializations', 'doctor', 'clinics', 'timetable'));
    }

    public function edit(User $user)
    {
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
        if ($photos==true) {
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
        $clinics = Clinic::orderBy('name_ru')->pluck('name_ru', 'id');
        return view('admin.users.clinics', compact('user', 'clinics'));
    }

    
}
