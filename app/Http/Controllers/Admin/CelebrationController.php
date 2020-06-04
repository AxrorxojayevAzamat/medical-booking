<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Celebration;
use App\Http\Requests\CelebrationRequest;
use Illuminate\Http\Request;

class CelebrationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $celebrations = Celebration::orderBy('id', 'asc')
            ->paginate(1000000);
        return view('admin.celebrations.index', compact('celebrations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.celebrations.create');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CelebrationRequest $request)
    {
        $celebrations = new Celebration();

        $celebrations->date = $request->date;
        $celebrations->quantity = $request->quantity;
        $celebrations->name = $request->celebration_name;
        $celebrations->save();

        return redirect()->route('admin.celebration.index')->with('success', 'Успешно!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Celebration $celebration)
    {
        $celebrations = Celebration::find($celebration->id);
        return view('admin.celebrations.edit', compact('celebrations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CelebrationRequest $request, $id)
    {
        $celebrations = Celebration::find($id);
        $celebrations->date = $request->date;
        $celebrations->quantity = $request->quantity;
        $celebrations->name = $request->celebration_name;
        $celebrations->update();
        $id = $celebrations->id;

        return redirect()->route('admin.celebration.index', compact('id'))->with('success', 'Отредактировано!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Celebration $celebration)
    {
        $celebrations = Celebration::find($celebration->id);
        $celebrations->delete();
        return redirect()->route('admin.celebration.index')->with('success', 'Удалено!');
    }
}
