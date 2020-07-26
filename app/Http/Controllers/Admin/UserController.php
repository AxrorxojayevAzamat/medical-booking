<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Clinic\Clinic;
use App\Entity\User\Profile;
use App\Http\Controllers\Controller;
use App\Entity\User\Role;
use App\Entity\Clinic\Timetable;
use App\Entity\User\User;
use App\Entity\Clinic\Specialization;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Auth;
use Intervention\Image\Facades\Image;
use App\Traits\UploadTrait;
use Illuminate\Support\Str;

class UserController extends Controller
{
    use UploadTrait;

    public function __construct()
    {

    }

    public function index(Request $request)
    {
//                $this->authorize('manage-users');
        $this->authorize('manage-own-doctors');    
        $user = Auth::user();

        if ($user->isClinic()) {
            $query = User::forUser(Auth::user());
        }
        
        $query = User::select(['users.*', 'pr.*'])
            ->leftJoin('profiles as pr', 'users.id', '=', 'pr.user_id')
            ->orderByDesc('created_at');
        


        if (!empty($value = $request->get('id'))) {
            $query->where('id', $value);
        }

        if (!empty($value = $request->get('name'))) {
            $query->where('users.name', 'ilike', '%' . $value . '%');
        }

        if (!empty($value = $request->get('first_name'))) {
            $query->where('pr.first_name', 'ilike', '%' . $value . '%');
        }

        if (!empty($value = $request->get('last_name'))) {
            $query->where('pr.last_name', 'ilike', '%' . $value . '%');
        }

        if (!empty($value = $request->get('phone'))) {
            $query->where('users.phone', 'ilike', '%' . $value . '%');
        }

        if (!empty($value = $request->get('email'))) {
            $query->where('users.email', 'ilike', '%' . $value . '%');
        }

        if (!empty($value = $request->get('role'))) {
            $query->where('users.role', $value);
        }

        if (!empty($value = $request->get('status'))) {
            $query->where('users.status', $value);
        }

        $users = $query->paginate(20);

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

    public function store(Request $request)
    {
        $data = $request->all();

        DB::beginTransaction();
        try {
            $user = User::create([
                'phone' => $data['phone'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'status' => User::STATUS_ACTIVE,
                'role' => $data['role'],
            ]);

            $profile = $user->profile()->make([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'middle_name' => $data['middle_name'],
                'birth_date' => $data['birth_date'],
                'gender' => $data['gender'],
            ]);

            $folder = Profile::USER_PROFILE;
            $avatar = $request->file('avatar');
            if ($request->hasFile('avatar')) {
                $filename = Str::random(30) . '_' . time();
                $this->uploadOne($avatar, $folder, 'public', $filename);
                $filePath = $filename . '.' . $avatar->getClientOriginalExtension();

                $profile->avatar = $filePath;
            }

            $profile->save();

            DB::commit();

            return redirect()->route('admin.users.show', $user);
        } catch (\Exception $e) {
            DB::rollBack();
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

    public function update(Request $request, User $user)
    {
        $profile = $user->profile;
        DB::beginTransaction();
        try {
            if (!empty($request['password'])) {
                $input = $request->all();
                $input['password'] = bcrypt($input['password']);

                $user->update($input);
            } else {
                $user->update($request->except(['password']));
            }

            if (!$profile) {
                $profile = $user->profile()->make([
                    'first_name' => $request['first_name'],
                    'last_name' => $request['last_name'],
                    'middle_name' => $request['middle_name'],
                    'birth_date' => $request['birth_date'],
                    'gender' => $request['gender'],
                    'about_uz' => $request['about_uz'],
                    'about_ru' => $request['about_ru'],
                ]);
            } else {
                $profile->edit(
                    $request['first_name'],
                    $request['last_name'],
                    $request['birth_date'],
                    $request['gender'],
                    $request['middle_name'],
                    $request['about_uz'],
                    $request['about_ru']
                );
            }

            $profile->save();

            $folder = Profile::USER_PROFILE;
            $avatar = $request->file('avatar');
            if ($request->hasFile('avatar')) {
                $this->deleteOne($folder, 'public', $profile->avatar);
                $filename = Str::random(30) . '_' . time();
                $this->uploadOne($avatar, $folder, 'public', $filename);
                $filePath = $filename . '.' . $avatar->getClientOriginalExtension();

                $profile->avatar = $filePath;
            }

            DB::commit();

            return redirect()->route('admin.users.show', $user);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy(User $user)
    {
        $user->delete();

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
}
