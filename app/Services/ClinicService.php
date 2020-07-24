<?php

namespace App\Services;

use App\Helpers\ImageHelper;
use App\Entity\Clinic\Clinic;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ClinicRequest;
use Illuminate\Support\Facades\Storage;

class ClinicService
{
    public function create(ClinicRequest $request)
    {
        try {
            $clinic = Clinic::make([

            'name_uz' => $request->name_uz,
            'name_ru' => $request->name_ru,
            'region_id' => $request->region_id,
            'type' => $request->type,
            'description_uz' => $request->description_uz,
            'description_ru' => $request->description_ru,
            'address_uz' => $request->adress_uz,
            'address_ru' => $request->adress_ru,
            'work_time_start' => $request->work_time_start,
            'work_time_end' => $request->work_time_end,
            'location' => $request->location,
        
        ]);
            $clinic->save();
            return $clinic;
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    public function update($id, ClinicRequest $request)
    {
        $clinic = Clinic::find($id);
        try {
            $clinic->update([
                'name_uz' => $request->name_uz,
                'name_ru' => $request->name_ru,
                'region_id' => $request->region_id,
                'type' => $request->type,
                'description_uz' => $request->description_uz,
                'description_ru' => $request->description_ru,
                'phone_numbers' => $request->phone_numbers,
                'address_uz' => $request->address_uz,
                'address_ru' => $request->address_ru,
                'work_time_start' => $request->work_time_start,
                'work_time_end' => $request->work_time_end,
                'location' => $request->location,
            ]);
            $clinic->save();
            return $clinic;
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    
    public function addMainPhoto(int $id, UploadedFile $image)
    {
        $this->addPhoto($id, $image, true);
    }
    
    public function addPhoto(int $id, UploadedFile $image, bool $main = false): void
    {
        $clinic = Clinic::findOrFail($id);
        $imageName = ImageHelper::getRandomName($image);
        DB::beginTransaction();
        try {
            if (!$main) {
                $photo = $clinic->photos()->create([
                    'clinic_id' => $clinic->id,
                    'filename' => $imageName,
                    'sort' => 100,
                ]);
                $this->sortPhotos($clinic);
            } else {
                $photo = $clinic->mainPhoto()->create([
                    'clinic_id' => $clinic->id,
                    'filename' => $imageName,
                    'sort' => 1,
                    ]);
                $clinic->update([
                    'main_photo_id' => $photo->id
                    ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        ImageHelper::uploadResizedImage($clinic->id, ImageHelper::FOLDER_CLINICS, $image, $imageName);
    }

    public function removeMainPhoto(int $id): bool
    {
        $clinic = Clinic::findOrFail($id);

        $this->deletePhotos($clinic->id, $clinic->mainPhoto->filename);
        DB::beginTransaction();
        try {
            $clinic->update(['main_photo_id' => null]);
            $clinic->mainPhoto()->delete();
            $this->sortPhotos($clinic);
            
            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
    private function deletePhotos(int $clinicId, string $filename)
    {
        Storage::disk('public')->delete('/images/' . ImageHelper::FOLDER_CLINICS . '/' . $clinicId . '/' . ImageHelper::TYPE_ORIGINAL . '/' . $filename);
        Storage::disk('public')->delete('/images/' . ImageHelper::FOLDER_CLINICS . '/' . $clinicId . '/' . ImageHelper::TYPE_THUMBNAIL . '/' . $filename);

        Storage::disk('public')->deleteDirectory('/images/' . ImageHelper::FOLDER_CLINICS . '/' . $clinicId);
    }

    private function sortPhotos(Clinic $clinic): void
    {
        foreach ($clinic->photos as $i => $photo) {
            $photo->setSort($i + 2);
            $photo->saveOrFail();
        }
    }
    public function removePhoto(int $id, int $photoId): bool
    {
        $clinic = Clinic::findOrFail($id);

        if ($clinic->main_photo_id === $photoId) {
            throw new \Exception('Cannot delete main photo.');
        }

        $photo = $clinic->photos()->findOrFail($photoId);
        $this->deletePhotos($clinic->id, $photo->filename);

        DB::beginTransaction();
        try {
            $photo->delete();
            $this->sortPhotos($clinic);

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
    public function multiplePhotoDelete($clinic)
    {
        $photos = $clinic->photos;
        try {
            foreach ($photos as $i => $photo) {
                $this->removePhoto($clinic->id, $photo->id);
            }
            return true;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function movePhotoUp(int $id, int $photoId): void
    {
        $clinic = Clinic::findOrFail($id);
        $photos = $clinic->photos;
        foreach ($photos as $i => $photo) {
            if ($photo->isIdEqualTo($photoId)) {
                if (!isset($photos[$i - 1])) {
                    $previous = $photos->last();
                    $photos[count($photos) - 1] = $photo;
                    $photos[$i] = $previous;
                } else {
                    $previous = $photos[$i - 1];
                    $photos[$i - 1] = $photo;
                    $photos[$i] = $previous;
                }
                $clinic->photos = $photos;
                DB::beginTransaction();
                try {
                    $this->sortPhotos($clinic);
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();
                    throw $e;
                }
                return;
            }
        }
    }

    public function movePhotoDown(int $id, int $photoId): void
    {
        $clinic = Clinic::findOrFail($id);
        $photos = $clinic->photos;
        foreach ($photos as $i => $photo) {
            if ($photo->isIdEqualTo($photoId)) {
                if (!isset($photos[$i + 1])) {
                    $next = $photos->first();
                    $photos[0] = $photo;
                    $photos[$i] = $next;
                } else {
                    $next = $photos[$i + 1];
                    $photos[$i + 1] = $photo;
                    $photos[$i] = $next;
                }
                $clinic->photos = $photos;
                DB::beginTransaction();
                try {
                    $this->sortPhotos($clinic);
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();
                    throw $e;
                }
                return;
            }
        }
    }
}
