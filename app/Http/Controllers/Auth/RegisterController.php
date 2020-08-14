<?php

namespace App\Http\Controllers\Auth;

use App\Entity\User\User;
use App\Http\Controllers\Controller;
use App\Services\RegisterService;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{

    private $service;

    public function __construct(RegisterService $service)
    {
        $this->middleware('guest');
        $this->service = $service;
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $this->service->register($request);

        return redirect()->route('login')
                        ->with('success', 'Проверьте свою электронную почту и нажмите ссылку, чтобы подтвердить.');
    }

    public function verify($token)
    {
        if (!$user = User::where('verify_token', $token)->first()) {

            return redirect()->route('login')
                            ->with('error', 'Извините, ваша ссылка не может быть идентифицирована.');
        }

        try {
            $this->service->verify($user->id);
            return redirect()->route('login')->with('success', 'Ваш адрес электронной почты подтвержден. Теперь вы можете войти.');
        } catch (\DomainException $e) {
            return redirect()->route('login')->with('error', $e->getMessage());
        }
    }

}
