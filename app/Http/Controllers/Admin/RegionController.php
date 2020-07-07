<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegionRequest;
use App\Entity\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{

    public function index(Request $request)
    {
        $query = Region::orderByDesc('regions.id');

        if (!empty($value = $request->get('name'))) {
            $query->where(function ($query) use ($value) {
                $query->where('name_uz', 'ilike', '%' . $value . '%')
                    ->orWhere('name_ru', 'ilike', '%' . $value . '%');
            });
        }

        $categories = Region::where('parent_id', null);

        $regions = $query->paginate(20);
        return view('admin.regions.index', compact('regions', 'categories'));
    }

    public function create()
    {
        $parents = Region::where('parent_id', null)->pluck('name_ru', 'id');
        return view('admin.regions.create', compact('parents'));
    }

    public function store(RegionRequest $request)
    {
        $parentId = null;
        foreach (array_reverse($request->parents) as $parent) {
            if ($parent) {
                $parentId = $parent;
                break;
            }
        }

        $region = Region::create([
            'name_uz' => $request->name_uz,
            'name_ru' => $request->name_ru,
            'parent_id' => $parentId,
        ]);

        return redirect()->route('admin.regions.show', $region);
    }

    public function show(Region $region)
    {
        return view('admin.regions.show', compact('region'));
    }

    public function edit(Region $region)
    {
        $parents = [];
        $parent = $region->parent;
        while ($parent) {
            $parents[] = $parent;
            $parent = $parent->parent;
        }
        $parents = array_reverse($parents);

        return view('admin.regions.edit', compact('region', 'parents'));
    }

    public function update(RegionRequest $request, Region $region)
    {
        $parentId = null;
        foreach (array_reverse($request->parents) as $parent) {
            if ($parent) {
                $parentId = $parent;
                break;
            }
        }

        $region->update([
            'name_uz' => $request->name_uz,
            'name_ru' => $request->name_ru,
            'parent_id' => $parentId,
        ]);

        return redirect()->route('admin.regions.show', $region)->with('success', 'Отредактировано!');
    }

    public function destroy(Region $region)
    {
        if ($region->children()->exists()) {
            return redirect()->route('admin.regions.index')->with('dangerous', 'Нельзя удалить!');
        }

        $region->delete();

        return redirect()->route('admin.regions.index')->with('success', 'Удалено!');
    }

    public function findCity($id)
    {
        $city = Region::where('parent_id', $id)->pluck('name_ru', 'id');
        return json_encode($city);
    }
}
