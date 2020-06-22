<?php

namespace App\Http\Controllers;

use App\Entity\User\Profile;
use Illuminate\Http\Request;
use Auth;
use Intervention\Image\Facades\Image;
use App\Traits\UploadTrait;
use App\Entity\User\User;
use Illuminate\Support\Str;

class ProfileController extends Controller {

    use UploadTrait;

    public function __construct() {
        $this->middleware('auth');
    }

    public function profile() {
        return view('profile', array('user' => Auth::user()));
    }

    public function updateAvatar(Request $request) {

        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $user = Auth::user();
        $profile = $user->profile;
        $folder = Profile::USER_PROFILE;
        $avatar = $request->file('avatar');
        if ($request->hasFile('avatar')) {
            $this->deleteOne($folder,'public', $profile->avatar);
            $filename = Str::random(30) . '_' . time();
            $this->uploadOne($avatar, $folder, 'public', $filename);
            $filePath = $filename . '.' . $avatar->getClientOriginalExtension();

            $profile->avatar = $filePath;
            $profile->save();
        }

        return redirect()->back()->with(['status' => 'Фотография пользователя обновлен.']);
    }

}
