<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use App\Specialization;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Auth;
use Intervention\Image\Facades\Image;

class UserController extends Controller {

    public function index(Request $request) {
        $query = User::orderByDesc('id');
        $this->validate($request, [
            'id' => ['integer', 'nullable'],
        ]);

        if (!empty($value = $request->get('id'))) {
            $query->where('id', $value);
        }

        if (!empty($value = $request->get('name'))) {
            $query->where('name', 'ilike', '%' . $value . '%');
        }

        if (!empty($value = $request->get('lastname'))) {
            $query->where('lastname', 'ilike', '%' . $value . '%');
        }

        if (!empty($value = $request->get('phone'))) {
            $query->where('phone', 'ilike', '%' . $value . '%');
        }

        if (!empty($value = $request->get('email'))) {
            $query->where('email', 'ilike', '%' . $value . '%');
        }

        if (!empty($value = $request->get('role'))) {
            $query->where('role', $value);
        }

        if (!empty($value = $request->get('status'))) {
            $query->where('status', $value);
        }

        $users = $query->paginate(20);

        $roles = Role::orderBy('id')->pluck('name', 'id');

        $statuses = User::statusList();

        return view('admin.users.index', compact('users', 'roles', 'statuses'));
    }

    public function create() {
        $roles = Role::orderBy('name')->pluck('name', 'id');
        $statuses = User::statusList();
        return view('admin.users.create', compact('roles', 'statuses'));
    }

    public function store(Request $request) {
        $data = $request->all();
        $user = User::create([
                    'name' => $data['name'],
                    'lastname' => $data['lastname'],
                    'patronymic' => $data['patronymic'],
                    'phone' => $data['phone'],
                    'birth_date' => $data['birth_date'],
                    'gender' => $data['gender'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    'status' => User::STATUS_ACTIVE,
                    'role' => $data['role'],
        ]);
        if ($request->hasFile('avatar')) {
            User::avatar($request, $user);
        }

        return redirect()->route('admin.users.show', $user);
    }

    public function show(User $user) {
        $roles = Role::orderBy('name')->pluck('name', 'id');
        $specializations = Specialization::orderBy('name_ru')->pluck('name_ru', 'id');
        $doctorList = User::find($user->id);
        $statuses = User::statusList();

        return view('admin.users.show', compact('user', 'roles', 'specializations', 'doctorList', 'statuses'));
    }

    public function edit(User $user) {
        $roles = Role::orderBy('name')->pluck('name', 'id');
        $specializations = Specialization::orderBy('name_ru')->pluck('name_ru', 'id');
        $doctorList = User::find($user->id);
        $statuses = User::statusList();

        return view('admin.users.edit', compact('user', 'roles', 'specializations', 'doctorList', 'statuses'));
    }

    public function update(Request $request, User $user) {

        if (!empty($request['password'])) {
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);

            $user->update($input);
        } else {

            $user->update($request->except(['password']));
        }

        if ($request->hasFile('avatar')) {
            User::avatar($request, $user);
        }

        return redirect()->route('admin.users.show', $user);
    }

    public function destroy(User $user) {
        $user->delete();

        return redirect()->route('admin.users.index');
    }

    public function specialization(Request $request, User $user) {
        $user->specializations()->sync($request['specializationUser']);

        return redirect()->route('admin.users.show', $user);
    }

    public function additional(User $user) {
        $specializations = Specialization::orderBy('name_ru')->pluck('name_ru', 'id');

        return view('admin.users.additional', compact('user', 'specializations'));
    }

}
