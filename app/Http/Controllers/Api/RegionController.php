<?php

namespace App\Http\Controllers\Api;

use App\Entity\Region;
use App\Http\Controllers\Controller;

class RegionController extends Controller
{
    public function children(int $parent_id)
    {
//        $children = Region::where('parent_id', $parent_id)->pluck('name_ru', 'id');
        $children = Region::select(['id', 'name_ru as name'])->where('parent_id', $parent_id)->get();
        return response()->json($children);
    }
}
