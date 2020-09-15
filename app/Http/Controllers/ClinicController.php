<?php

namespace App\Http\Controllers;

use App\Entity\Clinic\Clinic;
use App\Entity\Clinic\ClinicService;
use App\Entity\Clinic\Contact;
use App\Entity\Clinic\Service;
use App\Entity\Region;
use App\Entity\User\User;
use App\Helpers\LanguageHelper;
use Illuminate\Http\Request;

class ClinicController extends Controller
{

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

        if (!empty($value = $request->get('service'))) {
            $clinicIds = ClinicService::where('service_id', $value)->pluck('clinic_id')->toArray();

            $query->whereIn('id', $clinicIds);
        }

        if (!empty($value = $request->get('region'))) {
            $regionIds = $this->getRegionIds($value);

            $query->whereIn('region_id', $regionIds);
        }

        $clinics = $query->paginate(10);

        $countAll = Clinic::count();
        $countCurrent = count($clinics);

        $regions = Region::where('parent_id', null)->pluck('name_' . LanguageHelper::getCurrentLanguagePrefix(), 'id');
        $services = Service::pluck('name_' . LanguageHelper::getCurrentLanguagePrefix(), 'id');
    
        $clinicLocations = array();
        foreach ($clinics as $key => $value) {

            $clinicLocations[] = ['clinicId' => $value->id,
                'clinicName' => $value->name_ . LanguageHelper::getCurrentLanguagePrefix(),
                'location' => $value->location
            ];
        }
        $clinicsJson = json_encode($clinicLocations);
        return view('clinics.index', compact('clinics', 'regions', 'countAll', 'countCurrent', 'clinicsJson', 'services'));
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

    public function show(Clinic $clinic)
    {
//        $contacts = $clinic->contacts()->orderBy('type')->get();
        $phoneNumbers = $clinic->contacts()->where('type', Contact::PHONE_NUMBER)->pluck('value');
        $faxNumbers = $clinic->contacts()->where('type', Contact::FAX_NUMBER)->pluck('value');
        $emails = $clinic->contacts()->where('type', Contact::EMAIL)->pluck('value');
        return view('clinics.show', compact('clinic', 'phoneNumbers', 'faxNumbers', 'emails'));
    }

}
