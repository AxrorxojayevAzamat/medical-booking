<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contacts;
use App\Rules\Captcha;
use Illuminate\Support\Facades\Mail;
use App\Mail\Email;

class ContactsController extends Controller
{
    public function index()
    {
        return view('contacts');
    }

    public function contacts(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'phone' => ['required', 'string', 'regex:/^\d{9}$/'],
            'message' => 'required',
            'g-recaptcha-response' => new Captcha(),
        ]);

        $contacts = Contacts::create([
            'name' => $request->input('name'),
            'lastname' => $request->input('lastname'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'message' => $request->input('message')
        ]);

        Mail::to('bookingmedical@gmail.com')->send(
            new Email(
                $request->input('name'),
                $request->input('lastname'),
                $request->input('email'),
                $request->input('phone'),
                $request->input('message')
            ));

        return redirect()->route('contacts.contacts')->with([
            'info' => 'Successfully sent!'
        ]);
    }

}
