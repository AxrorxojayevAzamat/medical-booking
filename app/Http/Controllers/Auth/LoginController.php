<?php

namespace App\Http\Controllers\Auth;

use App\Entity\User\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        session(['url.intended' => url()->previous()]);
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if (method_exists($this, 'hasTooManyLoginAttempts') &&
                $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            if (Auth::check()) {
                if (Auth::user()->isAdmin() || Auth::user()->isClinic() || Auth::user()->isCallCenter()) {
                    session(['url.intended' => route('admin.home')]);
                    $this->redirectTo = route('admin.home');
                }
                if (Auth::user()->isPatient()) {
                    $this->redirectTo = session()->get('url.intended');
                    //$this->redirectTo = route('patient.profile');
                }
                if (Auth::user()->isDoctor()) {
                    $this->redirectTo = session()->get('url.intended');
                    //$this->redirectTo = route('doctor.profile');
                }
            }

            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return $this->loggedOut($request) ?: redirect($this->redirectTo);
    }

    public function authenticated(Request $request, $user)
    {
        if (!$user->isActive()) {
            $this->guard()->logout();
            return back()->with('error', 'Вам необходимо подтвердить свой аккаунт. Пожалуйста, проверьте свою электронную почту');
        }
        return redirect()->intended($this->redirectPath());
    }

}
