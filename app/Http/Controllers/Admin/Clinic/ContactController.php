<?php

namespace App\Http\Controllers\Admin\Clinic;

use App\Entity\Clinic\Clinic;
use App\Entity\Clinic\Contact;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClinicContactRequest;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:manage-clinics');
    }

    public function create(Clinic $clinic)
    {
        $types = Contact::getTypeList();

        return view('admin.clinics.contacts.create', compact('clinic', 'types'));
    }

    public function store(ClinicContactRequest $request, Clinic $clinic)
    {
        try {
            $contact = $clinic->contacts()->create([
                'type' => $request->type,
                'value' => $request->value,
            ]);

            return redirect()->route('admin.clinics.contacts.show', ['clinic' => $clinic, 'contact' => $contact]);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function show(Clinic $clinic, Contact $contact)
    {
        return view('admin.clinics.contacts.show', compact('clinic', 'contact'));
    }

    public function edit(Clinic $clinic, Contact $contact)
    {
        $types = Contact::getTypeList();

        return view('admin.clinics.contacts.edit', compact('clinic', 'contact', 'types'));
    }

    public function update(ClinicContactRequest $request, Clinic $clinic, Contact $contact)
    {
        try {
            $contact->update([
                'type' => $request->type,
                'value' => $request->value,
            ]);

            return redirect()->route('admin.clinics.contacts.show', ['clinic' => $clinic, 'contact' => $contact]);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Clinic $clinic, Contact $contact)
    {
        $contact->delete();

        return redirect()->route('admin.clinics.show', $clinic);
    }
}
