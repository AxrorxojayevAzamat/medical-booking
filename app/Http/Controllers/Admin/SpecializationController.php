<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Entity\Clinic\Specialization;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Specialization\CreateRequest;
use App\Http\Requests\Admin\Specialization\UpdateRequest;

class SpecializationController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:manage-specializations');
    }

    public function index()
    {
        $query = Specialization::orderByDesc('updated_at');

        $specializations = $query->paginate(20);

        return view('admin.specializations.index', compact('specializations'));
    }

    public function create()
    {
        return view('admin.specializations.create');
    }

    public function store(CreateRequest $request)
    {
        $data = $request->all();
        Specialization::new($data['name_uz'], $data['name_ru']);

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
