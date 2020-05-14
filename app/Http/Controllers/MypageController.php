<?php

namespace App\Http\Controllers;

use App\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MypageController extends Controller
{


    public function index()
    {
        $user = Auth::user();
        $user_profile = UserProfile::where('user_id', $user->id)->first();

        return view('mypage.index')
            ->with('user', $user)
            ->with('user_profile', $user_profile);
    }

    public function edit()
    {
        return view('mypage.edit');
    }

    public function confirm(Request $request)
    {
        $file = $request->file('img_url');

        $path = Storage::disk('s3')->putFile('/', $file, 'public');
        dd(Storage::disk('s3')->url($path));
        //Todo
        //バリデーションをここで使う
        return view('mypage.confirm')->with('data', $request);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $user_profile = UserProfile::where('user_id', $user->id)->first();

        if(empty($user_profile)){
            $user_profile = new UserProfile;
            $user_profile->user_id = Auth::user()->id;
        }
        
        $user_profile->fill($request->all());
        $user_profile->save();

        return redirect()->route('mypage.complete');
    }

    public function complete()
    {
        return view('mypage.complete');
    }
}
