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
        $store = Clinic::findOrFail($request->id);
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
            //$this->sortPhotos($clinic);
            
            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
    private function deletePhotos(int $clinicId, string $filename)
    {
        Storage::disk('public')->delete('/images/' . ImageHelper::FOLDER_CLINICS . '/' . $clinicId . '/' . ImageHelper::TYPE_THUMBNAIL . '/' . $filename);
        Storage::disk('public')->delete('/images/' . ImageHelper::FOLDER_CLINICS . '/' . $clinicId . '/' . ImageHelper::TYPE_ORIGINAL . '/' . $filename);
    }

    private function sortPhotos(Clinic $clinic): void
    {
        foreach ($clinic->photos as $i => $photo) {
            $photo->setSort($i + 2);
            $photo->saveOrFail();
        }
    }
}
