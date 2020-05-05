<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Intervention\Image\Facades\Image;
use App\Traits\UploadTrait;
use App\User;
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
        $folder = User::USER_PROFILE;
        $avatar = $request->file('avatar');
        if ($request->hasFile('avatar')) {
            $this->deleteOne($folder,'public', $user->avatar);
            $filename = Str::slug($user->name) . '_' . time();
            $this->uploadOne($avatar, $folder, 'public', $filename);
            $filePath = $filename . '.' . $avatar->getClientOriginalExtension();

            $user->avatar = $filePath;
        }
        $user->save();


        return redirect()->back()->with(['status' => 'Фотография пользователя обновлен.']);
    }

}
