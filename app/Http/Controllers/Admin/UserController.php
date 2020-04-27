<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use App\Specialization;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller {

    public function index(Request $request) {
        $query = User::orderByDesc('id');

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

        if (!empty($value = $request->get('birth_date'))) {
            $query->where('birth_date', $value);
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
        return view('admin.users.index', compact('users', 'roles'));
    }

    public function create() {
        $roles = Role::orderBy('name')->pluck('name', 'id');
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request) {
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);

        return redirect()->route('admin.users.show', $user);
    }

    public function show(User $user) {
        $roles = Role::orderBy('name')->pluck('name', 'id');
        $specializations = Specialization::orderBy('name_ru')->pluck('name_ru', 'id');
        $doctorlist = User::find($user->id);

        return view('admin.users.show', compact('user', 'roles', 'specializations', 'doctorlist'));
    }

    public function edit(User $user) {
        $roles = Role::orderBy('name')->pluck('name', 'id');
        //$user = User::findOrFail($id);

        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user) {
        $user->update($request->except(['role']));

//        $user->roles()->attach($request['role']);

        return redirect()->route('admin.users.index');
    }

    public function destroy(User $user) {
        $user->delete();

        return redirect()->route('admin.users.index');
    }

    public function specialization(Request $request, User $user) {
        $user1 = User::find(2);
        $user1->specializations()->attach([1]);
//        $user1->specializations()->sync(1,true);
        return redirect()->route('admin.users.show', $user1);
    }

}
