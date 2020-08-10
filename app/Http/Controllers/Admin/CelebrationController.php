<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Entity\Celebration;
use App\Http\Requests\Admin\Celebration\CreateRequest;
use App\Http\Requests\Admin\Celebration\UpdateRequest;

class CelebrationController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:manage-celebrations');
    }

    public function index()
    {
        $celebrations = Celebration::orderBy('id', 'asc')
                ->paginate(1000000);
        return view('admin.celebrations.index', compact('celebrations'));
    }

    public function create()
    {
        return view('admin.celebrations.create');
    }

    public function store(CreateRequest $request)
    {
        $data = $request->all();
        Celebration::new($data['name_uz'], $data['name_ru'], $data['date'], $data['quantity'], Celebration::ACTIVE);

        return redirect()->route('admin.celebration.index')->with('success', 'Успешно!');
    }

    public function edit(Celebration $celebration)
    {
        return view('admin.celebrations.edit', compact('celebration'));
    }

    public function update(UpdateRequest $request, $id)
    {
        
        $celebrations = Celebration::findOrFail($id);
        $celebrations->name_uz = $request->name_uz;
        $celebrations->name_ru = $request->name_ru;
        $celebrations->date = $request->date;
        $celebrations->quantity = $request->quantity;
        $celebrations->update();

        return redirect()->route('admin.celebration.index', compact('celebration'))->with('success', 'Отредактировано!');
    }

    public function destroy(Celebration $celebration)
    {
        $celebrations = Celebration::find($celebration->id);
        $celebrations->delete();
        return redirect()->route('admin.celebration.index')->with('success', 'Удалено!');
    }

}
