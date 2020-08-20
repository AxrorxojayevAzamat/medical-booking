<?php

namespace App\Services;

use App\Entity\User\User;
use App\Http\Requests\RegisterRequest;
use App\Mail\Auth\VerifyMail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Mail\Mailer;

class RegisterService
{

    private $mailer;
    private $dispatcher;

    public function __construct(Mailer $mailer, Dispatcher $dispatcher)
    {
        $this->mailer = $mailer;
        $this->dispatcher = $dispatcher;
    }

    public function register(RegisterRequest $request): void
    {

        $user = User::register($request['email'],
                        $request['password'],
                        $request['phone'],
                        $request['first_name'],
                        $request['last_name'],
                        $request['middle_name'],
                        $request['birth_date'],
                        $request['gender']
        );
        $this->mailer->to($user->email)->send(new VerifyMail($user));
        $this->dispatcher->dispatch(new Registered($user));
    }

    public function verify($id): void
    {
        /** @var User $user */
        $user = User::findOrFail($id);
        $user->markEmailAsVerified();
        $user->verify();
    }

}
