<?php

namespace App\Services;

use App\Entity\Partner;
use App\Helpers\ImageHelper;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PartnerRequest;

class PartnerService
{
    public function create(PartnerRequest $request): Partner
    {
        $data = $request->all();
        if (!$request->photo) {
            $partner = Partner::create([
                'name'=>$data['name'],
                'site_url'=>$data['site_url'],
                'sort'=>100,
                'status'=>$data['status'],
    
            ]);
            $this->sortModifications($partner);
        } else {
            $imageName = ImageHelper::getRandomName($request->photo);
            $partner = Partner::add($request->name, $request->site_url, $request->sort, $request->status, $imageName);
    
            $this->uploadphoto($partner->id, $request->photo, $imageName);
        }
        
       
        return $partner;
    }
    
    public function update($id, PartnerRequest $request): Partner
    {
        $partner = Partner::find($id);
        $data = $request->all();
        if (!$request->photo) {
            $partner->update([
                'name'=>$data['name'],
                'site_url'=>$data['site_url'],
                'sort'=>$data['sort'],
                'status'=>$data['status'],
                ]);
        } else {
            Storage::disk('public')->deleteDirectory('/images/' . ImageHelper::FOLDER_PARTNERS . '/' . $partner->id);
            $imageName = ImageHelper::getRandomName($request->photo);
            $partner->update([
                'name'=>$data['name'],
                'site_url'=>$data['site_url'],
                'sort'=>$data['sort'],
                'status'=>$data['status'],
                'photo'=>$imageName,
                ]);

            $this->uploadphoto($partner->id, $request->photo, $imageName);
        }

        return $partner;
    }

    public function addPhoto(int $id, UploadedFile $image)
    {
        $partner = Partner::findOrFail($id);
        $imageName = ImageHelper::getRandomName($image);
        $partner->update([
            'photo' => $imageName
            ]);

        ImageHelper::uploadResizedImage($partner->id, ImageHelper::FOLDER_PARTNERS, $image, $imageName);
    }
    
    public function removePhoto(int $id): bool
    {
        $partner = Partner::findOrFail($id);

        $this->deletePhotos($partner->id, $partner->photo);
        
        try {
            $partner->update(['photo' => null]);
         
            return true;
        } catch (\Exception $e) {
            throw $e;
        }
    }
   
    public function deletePhotos(int $partnerId, string $filename):bool
    {
        Storage::disk('public')->delete('/images/' . ImageHelper::FOLDER_PARTNERS . '/' . $partnerId . '/' . ImageHelper::TYPE_ORIGINAL . '/' . $filename);
        Storage::disk('public')->delete('/images/' . ImageHelper::FOLDER_PARTNERS . '/' . $partnerId . '/' . ImageHelper::TYPE_THUMBNAIL . '/' . $filename);

        Storage::disk('public')->deleteDirectory('/images/' . ImageHelper::FOLDER_PARTNERS . '/' . $partnerId);
        return true;
    }
    private function uploadphoto(int $partnerId, UploadedFile $photo, string $imageName)
    {
        ImageHelper::saveThumbnail($partnerId, ImageHelper::FOLDER_PARTNERS, $photo, $imageName);
        ImageHelper::saveOriginal($partnerId, ImageHelper::FOLDER_PARTNERS, $photo, $imageName);
    }

    private function sortModifications(Partner $partner): void
    {
        $partners= Partner::all();
        foreach ($partners as $i => $partner) {
            $partner->setSort($i + 1);
        }
        $partner->saveOrFail();
    }

    public function moveToFirst(int $partnerId): void
    {
        $partners = Partner::all();
        foreach ($partners as $i => $partner) {
            if ($partner->isIdEqualTo($partnerId)) {
                for ($j = $i; $j >= 0; $j--) {
                    if (!isset($partners[$j - 1])) {
                        break(1);
                    }
                    
                    $prev = $partners[$j - 1];
                    $partners[$j - 1] = $partners[$j];
                    $partners[$j] = $prev;
                }
                //$partner->sort = $partners;
                //$partners->saveOrFail();
                //dd($partners);

                try {
                    $this->sortModifications($partner);
                } catch (\Exception $e) {
                    throw $e;
                }
                return;
            }
        }
    }
}
