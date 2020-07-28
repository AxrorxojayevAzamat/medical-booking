<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Entity\Clinic\Specialization;
use Illuminate\Http\Request;

class SpecializationController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:manage-specializations');
    }

    public function index()
    {

        $specializations = Specialization::all();

        return view('admin.specializations.index', compact('specializations'));
    }

    public function create()
    {
        return view('admin.specializations.create');
    }

    public function store(Request $request)
    {
        Specialization::create($request->all());
        return redirect()->route('admin.specializations.index');
    }

    public function show(Specialization $specialization)
    {
        return view('admin.specializations.show', compact('specialization'));
    }

    public function edit(Specialization $specialization)
    {
        return view('admin.specializations.edit', compact('specialization'));
    }

    public function update(Request $request, Specialization $specialization)
    {
        $specialization->update($request->all());

        return redirect()->route('admin.specializations.index');
    }

    public function destroy(Specialization $specialization)
    {
        $specialization->delete();

        return redirect()->route('admin.specializations.index');
    }

}
