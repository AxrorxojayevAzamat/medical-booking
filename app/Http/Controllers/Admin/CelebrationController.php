<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Entity\Celebration;
use App\Http\Requests\BookRequest;
use Illuminate\Http\Request;

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

    public function store(BookRequest $request)
    {
        $celebrations = new Celebration();

        $celebrations->date = $request->date;
        $celebrations->quantity = $request->quantity;
        $celebrations->name = $request->celebration_name;
        $celebrations->save();

        return redirect()->route('admin.celebration.index')->with('success', 'Успешно!');
    }

    public function edit(Celebration $celebration)
    {
        $celebrations = Celebration::find($celebration->id);
        return view('admin.celebrations.edit', compact('celebrations'));
    }

    public function update(BookRequest $request, $id)
    {
        $celebrations = Celebration::find($id);
        $celebrations->date = $request->date;
        $celebrations->quantity = $request->quantity;
        $celebrations->name = $request->celebration_name;
        $celebrations->update();
        $id = $celebrations->id;

        return redirect()->route('admin.celebration.index', compact('id'))->with('success', 'Отредактировано!');
    }

    public function destroy(Celebration $celebration)
    {
        $celebrations = Celebration::find($celebration->id);
        $celebrations->delete();
        return redirect()->route('admin.celebration.index')->with('success', 'Удалено!');
    }

}
