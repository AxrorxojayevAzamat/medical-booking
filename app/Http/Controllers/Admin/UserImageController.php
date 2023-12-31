<?php

namespace App\Http\Controllers\Admin;

use App\Entity\User\User;
use App\Entity\User\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entity\Book\Book;
use App\Services\UserService;
use App\Entity\User\Photo;
use Auth;

class UserImageController extends Controller
{
   private $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function mainPhoto(User $user)
    {
        
        if(Auth::user()->isDoctor()){
        	$profile = Profile::find(Auth::id());
        	$user = User::find(Auth::user()->id);
        	$book_num = count(Book::where('doctor_id', $user->id)->get());
        	return view('doctor.add-main-photo', compact('profile','user','book_num'));
        }

        $profile = Profile::find($user->id);
        return view('admin.users.add-main-photo', compact('profile'));
    }
    public function addMainPhoto(User $user, Request $request)
    {
        try {
            $this->validate($request, ['photo' => 'required|image|mimes:jpg,jpeg,png']);
            if(Auth::user()->isDoctor()){
                $this->service->addMainPhoto(Auth::id(), $request->photo);
                return redirect()->route('doctor.profile')->with('success', 'Успешно сохранено!');
            }
            $this->service->addMainPhoto($user->id, $request->photo);
            return redirect()->route('admin.users.show', $user)->with('success', 'Успешно сохранено!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    public function removeMainPhoto(User $user)
    {
        try {
            if(Auth::user()->isDoctor())
                $this->service->removeMainPhoto(Auth::id());
            else
                $this->service->removeMainPhoto($user->id);
            return response()->json('The main photo is successfully deleted!');
        } catch (\Exception $e) {
            return response()->json('The main photo is not deleted!', 400);
        }
    }
    public function photos(User $user)
    {
        if(Auth::user()->isDoctor()){
            $profile = Profile::findorFail(Auth::id());
            $book_num = count(Book::where('doctor_id', $user->id)->get());
            return view('doctor.add-photo', compact('profile','book_num'));
        }

        $profile = Profile::findorFail($user->id);
        return view('admin.users.add-photo', compact('profile'));
    }
    public function addPhoto(User $user, Request $request)
    {
    	if(Auth::user()->isDoctor()){
    		$profile = Profile::findorFail(Auth::id());
    	}
        else 
        	$profile = Profile::findorFail($user->id);
        try {
            $this->validate($request, ['photo' => 'required|image|mimes:jpg,jpeg,png']);
            $this->service->addPhoto($profile->user_id, $request->photo);
            session()->flash('message', 'asd');
            return back();
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function removePhoto(User $user, Photo $photo)
    {
    	if(Auth::user()->isDoctor()){
    		$profile = Profile::findorFail(Auth::id());
    	}
        else
        	$profile = Profile::findorFail($user->id);
        try {
            $this->service->removePhoto($profile->user_id, $photo->id);
        if(Auth::user()->isDoctor())
            return back()->with('success', 'true'); 
        
        return redirect()->route('admin.users.photos', $profile)->with('success', 'Успешно удалено!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function movePhotoUp(User $user, Photo $photo)
    {
    	if(Auth::user()->isDoctor()){
    		$profile = Profile::findorFail(Auth::id());
    	}
        else
        	$profile = Profile::findorFail($user->id);
        try {
            $this->service->movePhotoUp($profile->user_id, $photo->id);
            return back();
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function movePhotoDown(User $user, Photo $photo)
    {
    	if(Auth::user()->isDoctor()){
    		$profile = Profile::findorFail(Auth::id());
    	}
        else
        	$profile = Profile::findorFail($user->id);
        try {
            $this->service->movePhotoDown($profile->user_id, $photo->id);
            return back();
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    public function multiplePhotoDelete($clinic)
    {
    	if(Auth::user()->isDoctor()){
    		$profile = Profile::findorFail(Auth::id());
    	}
        else
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
}
