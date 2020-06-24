<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Entity\Clinic\Specialization;
use Illuminate\Http\Request;

class SpecializationController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $specializations = Specialization::all();

        return view('admin.specializations.index', compact('specializations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.specializations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        Specialization::create($request->all());
        return redirect()->route('admin.specializations.index');
    }

        /**
     * Display the specified resource.
     *
     * @param  \App\Entity\Clinic\Specialization  $specialization
     * @return \Illuminate\Http\Response
     */
    public function show(Specialization $specialization) {
        return view('admin.specializations.show', compact('specialization'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entity\Clinic\Specialization  $specialization
     * @return \Illuminate\Http\Response
     */
    public function edit(Specialization $specialization) {
        return view('admin.specializations.edit', compact('specialization'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entity\Clinic\Specialization  $specialization
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Specialization $specialization) {
        $specialization->update($request->all());

        return redirect()->route('admin.specializations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entity\Clinic\Specialization  $specialization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Specialization $specialization) {
        $specialization->delete();

        return redirect()->route('admin.specializations.index');
    }

}
