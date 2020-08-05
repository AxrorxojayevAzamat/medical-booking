<?php


namespace App\Services\Manage;


use App\Entity\Clinic\Clinic;
use App\Entity\Clinic\Service;
use App\Helpers\ImageHelper;
use App\Http\Requests\Admin\Services\CreateRequest;
use App\Http\Requests\Admin\Services\UpdateRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ClinicServicesService
{
    private $nextId;

    public function create(CreateRequest $request): Service
    {
        if (!$request->icon) {
            return Service::create([
                'title_uz' => $request->name_uz,
                'title_ru' => $request->name_ru,
                'description_uz' => $request->description_uz,
                'description_ru' => $request->description_ru,
            ]);
        }

        $imageName = ImageHelper::getRandomName($request->icon);

        $service = Service::add($this->getNextId(), $request, $imageName);

        $this->uploadImage($this->getNextId(), $request->icon, $imageName);

        return $service;
    }

    public function update(int $id, UpdateRequest $request): Service
    {
        $service = Service::findOrFail($id);

        if (!$request->icon) {
            $service->edit($request);
        } else {
            Storage::disk('public')->deleteDirectory('/images/' . ImageHelper::FOLDER_SERVICES . '/' . $service->id);

            $imageName = ImageHelper::getRandomName($request->icon);
            $service->edit($request, $imageName);

            $this->uploadImage($service->id, $request->icon, $imageName);
        }

        return $service;
    }

    public function getNextId(): int
    {
        if (!$this->nextId) {
            $nextId = DB::select("select nextval('services_id_seq')");
            return $this->nextId = intval($nextId['0']->nextval);
        }
        return $this->nextId;
    }

    public function removeImage(int $id): bool
    {
        $service = Service::findOrFail($id);
        $deleted = Storage::disk('public')->deleteDirectory('/images/' . ImageHelper::FOLDER_SERVICES . '/' . $service->id);
        $updated = $service->update(['image' => null]);
        return  $deleted || $updated;
    }

    private function uploadImage(int $id, UploadedFile $image, string $imageName): string
    {
        $sizes = getimagesize($image);

        ImageHelper::saveThumbnail($id, ImageHelper::FOLDER_SERVICES, $image, $imageName, (int) ($sizes[0] / 4), (int) ($sizes[1] / 4));
        ImageHelper::saveOriginal($id, ImageHelper::FOLDER_SERVICES, $image, $imageName);

        return $imageName;
    }

    public function moveServiceToFirst(int $id, int $serviceId): void
    {
        $clinic = Clinic::findOrFail($id);
        $values = $clinic->clinicServices;

        foreach ($values as $i => $value) {
            if ($value->isServiceIdEqualTo($serviceId)) {
                for ($j = $i; $j >= 0; $j--) {
                    if (!isset($values[$j - 1])) {
                        break(1);
                    }

                    $prev = $values[$j - 1];
                    $values[$j - 1] = $values[$j];
                    $values[$j] = $prev;
                }
                $clinic->clinicServices = $values;

                DB::beginTransaction();
                try {
                    $this->sortServices($clinic);
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();
                    throw $e;
                }
                return;
            }
        }
    }

    public function moveServiceUp(int $id, int $serviceId): void
    {
        $clinic = Clinic::findOrFail($id);
        $values = $clinic->clinicServices;

        foreach ($values as $i => $value) {
            if ($value->isServiceIdEqualTo($serviceId)) {
                if (!isset($values[$i - 1])) {
                    $count = count($values);

                    for ($j = 1; $j < $count; $j++) {
                        $next = $values[$j - 1];
                        $values[$j - 1] = $values[$j];
                        $values[$j] = $next;
                    }
                } else {
                    $previous = $values[$i - 1];
                    $values[$i - 1] = $value;
                    $values[$i] = $previous;
                }
                $clinic->clinicServices = $values;

                DB::beginTransaction();
                try {
                    $this->sortServices($clinic);
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();
                    throw $e;
                }
                return;
            }
        }
    }

    public function moveServiceDown(int $id, int $serviceId): void
    {
        $clinic = Clinic::findOrFail($id);
        $values = $clinic->clinicServices;

        foreach ($values as $i => $value) {
            if ($value->isServiceIdEqualTo($serviceId)) {
                if (!isset($values[$i + 1])) {
                    $last = $values->last();
                    $count = count($values);

                    for ($j = $count - 1; $j > 0; $j--) {
                        $values[$j] = $values[$j - 1];
                    }

                    $values[$j] = $last;
                } else {
                    $next = $values[$i + 1];
                    $values[$i + 1] = $value;
                    $values[$i] = $next;
                }
                $clinic->modifications = $values;

                DB::beginTransaction();
                try {
                    $this->sortServices($clinic);
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();
                    throw $e;
                }
                return;
            }
        }
    }

    public function moveServiceToLast(int $id, int $serviceId): void
    {
        $clinic = Clinic::findOrFail($id);
        $values = $clinic->clinicServices;

        foreach ($values as $i => $value) {
            if ($value->isServiceIdEqualTo($serviceId)) {
                $count = count($values);
                for ($j = $i; $j < $count; $j++) {
                    if (!isset($values[$j + 1])) {
                        break(1);
                    }

                    $next = $values[$j + 1];
                    $values[$j + 1] = $values[$j];
                    $values[$j] = $next;
                }
                $clinic->clinicServices = $values;

                DB::beginTransaction();
                try {
                    $this->sortServices($clinic);
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();
                    throw $e;
                }
                return;
            }
        }
    }

    private function sortServices(Clinic $clinic): void
    {
        foreach ($clinic->clinicServices as $i => $value) {
            $value->setSort($i + 1);
            DB::table('clinic_services')->where('clinic_id', $value->clinic_id)
                ->where('service_id', $value->service_id)->update(['sort' => ($i + 1)]);
        }
    }
}
