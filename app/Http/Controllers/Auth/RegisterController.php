<?php

namespace App\Http\Controllers\Auth;

use App\Entity\User\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use RegistersUsers;

    //protected $redirectTo = '/home';
    protected $redirectTo;

    public function __construct()
    {
        if (Auth::check() && Auth::user()->isAdmin())
        {
            $this->redirectTo = route('admin.home');
        } else {
            $this->redirectTo =  route('patient.dashboard1');
        }

        $this->middleware('guest');
    }

    protected function validator(array $data) {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'confirmed'],
            'phone' => ['required', 'string', 'max:18', 'unique:users'],
            'password' => ['required', 'string', 'min:2', 'confirmed'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'date'],
            'gender' => ['required', 'integer', 'min:0', 'max:1'],
        ]);
    }

    protected function create(array $data)
    {
        DB::beginTransaction();
        try {
            $user = User::create([
                'email' => $data['email'],
                'phone' => $data['phone'],
                'password' => bcrypt($data['password']),
                'status' => User::STATUS_ACTIVE,
                'role' => User::ROLE_USER,
            ]);

            $profile = $user->profile()->create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'patronymic' => $data['middle_name'],
                'birth_date' => $data['birth_date'],
                'gender' => $data['gender'],
            ]);

            DB::commit();

            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

    }

}
