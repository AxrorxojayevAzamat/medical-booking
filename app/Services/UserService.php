<?php

namespace App\Services;

use App\Entity\User\User;
use Illuminate\Support\Facades\DB;

class UserService
{
    public function search($request=null)
    {
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
        
        return $query;
    }

    public function create($request)
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

            $profile->save();
            DB::commit();

            // dd($user);
            return $profile;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
    public function update($request, $user)
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
            DB::commit();

            return $profile;
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}
