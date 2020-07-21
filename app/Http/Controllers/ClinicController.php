<?php

namespace App\Http\Controllers;

use App\Entity\Book\Book;
use App\Entity\Clinic\Clinic;
use App\Entity\Region;
use App\Entity\User\User;
use App\Helpers\LanguageHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClinicController extends Controller {


    public function index(Request $request)
    {
        $doctorIds = [];
        $query = Clinic::orderByDesc('created_at');

        if (!empty($value = $request->get('name'))) {
            $query->where(function ($query) use ($value) {
                $query->where('name_uz', 'ilike', '%' . $value . '%')
                    ->orWhere('name_ru', 'ilike', '%' . $value . '%');
            });
        }

        if (!empty($value = $request->get('region'))) {
            $regionIds = $this->getRegionIds($value);

            $query->whereIn('region_id', $regionIds);
        }

        $clinics = $query->paginate(10);

        $countAll = Clinic::count();
        $countCurrent = count($clinics);

        $regions = Region::where('parent_id', null)->pluck('name_' . LanguageHelper::getCurrentLanguagePrefix(), 'id');

        return view('clinics.index', compact('clinics', 'regions', 'countAll', 'countCurrent'));
    }

    private function getRegionIds($regionId): array
    {
        $region = Region::find($regionId);
        $allRegionIds = [$region->id];
        $regionIds = [$region->id];

        while (true) {
            $regionIds = Region::whereIn('parent_id', $regionIds)->pluck('id')->toArray();
            if (!$regionIds) {
                break;
            }
            $allRegionIds += $regionIds;
        }

        return $allRegionIds;
    }
}
