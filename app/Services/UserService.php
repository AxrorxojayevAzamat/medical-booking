<?php

namespace App\Services;

use App\Entity\User\User;
use App\Entity\User\Photo;
use App\Entity\User\Profile;
use App\Helpers\ImageHelper;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserService
{
    public function search($request=null)
    {
        $query = User::select(['users.*', 'pr.*'])
        ->leftJoin('profiles as pr', 'users.id', '=', 'pr.user_id')
        ->orderByDesc('created_at');

        if (!empty($value = $request->get('id'))) {
            $query->where('id', $value);
        }

        if (!empty($value = $request->get('name'))) {
            $query->where('users.name', 'ilike', '%' . $value . '%');
        }

        if (!empty($value = $request->get('first_name'))) {
            $query->where('pr.first_name', 'ilike', '%' . $value . '%');
        }

        if (!empty($value = $request->get('last_name'))) {
            $query->where('pr.last_name', 'ilike', '%' . $value . '%');
        }

        if (!empty($value = $request->get('phone'))) {
            $query->where('users.phone', 'ilike', '%' . $value . '%');
        }

        if (!empty($value = $request->get('email'))) {
            $query->where('users.email', 'ilike', '%' . $value . '%');
        }

        if (!empty($value = $request->get('role'))) {
            $query->where('users.role', $value);
        }

        if (!empty($value = $request->get('status'))) {
            $query->where('users.status', $value);
        }
        
        return $query;
    }

    public function create($request)
    {
        $data = $request->all();

        DB::beginTransaction();
        try {
            $user = User::create([
                'phone' => $data['phone'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'status' => User::STATUS_ACTIVE,
                'role' => $data['role'],
            ]);

            $profile = $user->profile()->make([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'middle_name' => $data['middle_name'],
                'birth_date' => $data['birth_date'],
                'gender' => $data['gender'],
            ]);

            $profile->save();
            DB::commit();

            return $profile;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
    public function update($request, $user)
    {
        $profile = $user->profile;
        DB::beginTransaction();
        try {
            if (!empty($request['password'])) {
                $input = $request->all();
                $input['password'] = bcrypt($input['password']);

                $user->update($input);
            } else {
                $user->update($request->except(['password']));
            }

            if (!$profile) {
                $profile = $user->profile()->make([
                    'first_name' => $request['first_name'],
                    'last_name' => $request['last_name'],
                    'middle_name' => $request['middle_name'],
                    'birth_date' => $request['birth_date'],
                    'gender' => $request['gender'],
                    'about_uz' => $request['about_uz'],
                    'about_ru' => $request['about_ru'],
                ]);
            } else {
                $profile->edit(
                    $request['first_name'],
                    $request['last_name'],
                    $request['birth_date'],
                    $request['gender'],
                    $request['middle_name'],
                    $request['about_uz'],
                    $request['about_ru']
                );
            }
            $profile->save();
            DB::commit();

            return $profile;
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

////////////////////////////////////////////////////////////////////////////////////////

    public function addMainPhoto(int $id, UploadedFile $image)
    {
        $this->addPhoto($id, $image, true);
    }
    
    public function addPhoto(int $id, UploadedFile $image, bool $main = false): void
    {
        $profile = Profile::find($id);
        $imageName = ImageHelper::getRandomName($image);
        
        DB::beginTransaction();
        try {
            if (!$main) {
                $photo = $profile->photos()->create([
                    'user_id' => $profile->filename,
                    'filename' => $imageName,
                    'sort' => 100,
                ]);
                $this->sortPhotos($profile);
            } else {
                $photo = $profile->mainPhoto()->create([
                    'user_id' => $profile->user_id,
                    'filename' => $imageName,
                    'sort' => 1,
                    ]);
                $profile->update([
                    'main_photo_id' => $photo->id
                    ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            throw $e;
        }
        ImageHelper::uploadResizedImage($profile->user_id, ImageHelper::FOLDER_USERS, $image, $imageName);
    }
    private function sortPhotos(Profile $profile): void
    {
        foreach ($profile->photos as $i => $photo) {
            $photo->setSort($i + 2);
            $photo->saveOrFail();
        }
    }
    public function removeMainPhoto(int $id): bool
    {
        $profile = Profile::findOrFail($id);
        $this->deletePhotos($profile->user_id, $profile->mainPhoto->filename);
        
        DB::beginTransaction();
        try {
            $profile->update(['main_photo_id' => null]);
            $profile->mainPhoto->delete();
            $this->sortPhotos($profile);
            
            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
   
    public function removePhoto(int $id, int $photoId): bool
    {
        $profile = Profile::findOrFail($id);

        if ($profile->main_photo_id === $photoId) {
            throw new \Exception('Cannot delete main photo.');
        }

        $photo = $profile->photos()->findOrFail($photoId);
        $this->deletePhotos($profile->user_id, $photo->filename);

        DB::beginTransaction();
        try {
            $photo->delete();
            $this->sortPhotos($profile);

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function deleteAllPhotos(User $user)
    {
        $profile = Profile::findOrFail($user->id);
        $photos = $profile->allPhotos;
        try {
            foreach ($photos as $i => $photo) {
                $this->deletePhotos($user->id, $photo->filename);
            }
            $this->deleteDirectory($profile->user_id);
            return true;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    private function deletePhotos(int $userId, string $filename)
    {
        Storage::disk('public')->delete('/images/' . ImageHelper::FOLDER_USERS . '/' . $userId . '/' . ImageHelper::TYPE_ORIGINAL . '/' . $filename);
        Storage::disk('public')->delete('/images/' . ImageHelper::FOLDER_USERS . '/' . $userId . '/' . ImageHelper::TYPE_THUMBNAIL . '/' . $filename);
    }

    private function deleteDirectory(int $userId)
    {
        Storage::disk('public')->deleteDirectory('/images/' . ImageHelper::FOLDER_USERS . '/' . $userId);
    }
    
    public function movePhotoUp(int $id, int $photoId): void
    {
        $profile = Profile::findOrFail($id);
        $photos = $profile->photos;
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
                $profile->photos = $photos;
                DB::beginTransaction();
                try {
                    $this->sortPhotos($profile);
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
        $profile = Profile::findOrFail($id);
        $photos = $profile->photos;
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
                $profile->photos = $photos;
                DB::beginTransaction();
                try {
                    $this->sortPhotos($profile);
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
