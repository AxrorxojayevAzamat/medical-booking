<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = '/home';
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name_ru' => ['required', 'string', 'max:255'],
            'name_uz' => ['required', 'string', 'max:255'],
            'lastname_ru' => ['required', 'string', 'max:255'],
            'lastname_uz' => ['required', 'string', 'max:255'],
            'patronymic_ru' => ['required', 'string', 'max:255'],
            'patronymic_uz' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:12'],
            'date_of_birth' => ['required', 'date'],
            'gender' => ['required', 'integer', 'min:0','max:1'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:2', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name_ru' => $data['name_ru'],
            'name_uz' => $data['name_uz'],
            'lastname_ru' => $data['lastname_ru'],
            'lastname_uz' => $data['lastname_uz'],
            'patronymic_ru' => $data['patronymic_ru'],
            'patronymic_uz' => $data['patronymic_uz'],
            'phone' => $data['phone'],
            'date_of_birth' => $data['date_of_birth'],
            'gender' => $data['gender'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $role = Role::where('slug', 'user')->first();
        $user->roles()->attach($role['id']);
        
        return $user;
    }
}
