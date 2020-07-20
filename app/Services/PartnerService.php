<?php

namespace App\Services;

use App\Entity\Partner;
use App\Helpers\ImageHelper;
use App\Http\Requests\PartnerRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PartnerService
{
    public function create(PartnerRequest $request): Partner
    {
        $data = $request->all();
        if (!$request->photo) {
            $partner = Partner::create([
                'name'=>$data['name'],
                'site_url'=>$data['site_url'],
                'sort'=>$data['sort'],
                'status'=>$data['status'],
    
            ]);
        } else {
            $imageName = ImageHelper::getRandomName($request->photo);
            $partner = Partner::add($request->name, $request->site_url, $request->sort, $request->status, $imageName);
    
            $this->uploadphoto($partner->id, $request->photo, $imageName);
        }
        
       
        return $partner;
    }
    
    public function update($id, PartnerRequest $request):Partner
    {
        $partner = Partner::find($id);
        //dd($partner);
        if (!$request->photo) {
            $partner->edit($request->name, $request->site_url, $request->sort, $request->status);
        }
        // else {
        //     Storage::disk('public')->deleteDirectory('/images/' . ImageHelper::FOLDER_PARTNERS . '/' . $partner->id);

        //     $imageName = ImageHelper::getRandomName($request->photo);
        //     $partner->edit($request->name, $request->site_url, $request->sort, $request->status);

        //     $this->uploadphoto($partner->id, $request->photo, $imageName);
        // }

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
        return true;
    }
    private function uploadphoto(int $partnerId, UploadedFile $photo, string $imageName)
    {
        ImageHelper::saveThumbnail($partnerId, ImageHelper::FOLDER_PARTNERS, $photo, $imageName);
        ImageHelper::saveOriginal($partnerId, ImageHelper::FOLDER_PARTNERS, $photo, $imageName);
    }
}
