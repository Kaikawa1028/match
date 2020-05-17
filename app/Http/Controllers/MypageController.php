<?php

namespace App\Http\Controllers;

use App\UserProfile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserProfileRequest;

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
        $user = Auth::user();

        $user_profile = UserProfile::where('user_id', $user->id)->first();

        return view('mypage.edit')
                ->with('user_profile', $user_profile);
    }

    public function confirm(UserProfileRequest $request)
    {

        $user = Auth::user();

        $user_profile = UserProfile::where('user_id', $user->id)->first();

        if(!empty($user_profile)){
            $user_name = $user_profile->user_name === $request->user_name ? '' : $request->user_name;
            $age = $user_profile->age == $request->age ? '' : $request->age;
            $residence = $user_profile->residence === $request->residence ? '' : $request->residence;
            $job = $user_profile->job === $request->job ? '' : $request->job;
            
            $text = $user_profile->text === $request->text ? '' : $request->text;
        }else {
            $user_name = $request->user_name;
            $age = $request->age;
            $residence = $request->residence;
            $job = $request->job;
            $text = $request->text;
        }

        $data = [
            "user_name" => $user_name,
            "age"       => $age,
            "residence" => $residence,
            "job"       => $job,
            "img_data"  => $request->img_data,
            "text"      => $text,
        ];

        //Todo
        //バリデーションをここで使う
        return view('mypage.confirm')
                ->with('data', $data);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $user_profile = UserProfile::where('user_id', $user->id)->first();

        if(empty($user_profile)){
            $user_profile = new UserProfile;
            $user_profile->user_id = Auth::user()->id;
        }

        $user_profile->user_name = is_null($request->user_name) ? $user_profile->user_name : $request->user_name;
        $user_profile->age = is_null($request->age) ? $user_profile->age : $request->age;
        $user_profile->residence = is_null($request->residence) ? $user_profile->residence : $request->residence;
        $user_profile->job = is_null($request->job) ? $user_profile->job : $request->job;
        $user_profile->text = is_null($request->text) ? $user_profile->text : $request->text;

        if(!is_null($request->img_data)) {
            $file_name = 'profileImg.png';
            $file_directory = $user->id;
            $file_path = $file_directory . "/" . $file_name;

            if(Storage::disk('s3')->exists($file_path)) {
                Storage::disk('s3')->delete($file_path);
            }

            $img_data = str_replace('data:image/png;base64,', '', $request->img_data);
            $data = base64_decode($img_data);
        
            file_put_contents("$file_name", $data);

            $path = Storage::disk('s3')->putFile($file_directory, $file_name, "public");
            $user_profile->img_url = Storage::disk('s3')->url($path);
        }

        $user_profile->save();

        return redirect()->route('mypage.complete');
    }

    public function complete()
    {
        return view('mypage.complete');
    }
}
