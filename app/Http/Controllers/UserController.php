<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        //$user = Auth::user();


        //男性か女性を判定
        //$target_sex =  $user->sex == 1 ? 0 : 1;

        $target_sex = 0;
        
        //対象の性別のuserを引っ張ってくる。$requestが存在している場合はその条件も合わせる。デフォルトは新着順(登録された順)
        $query = User::query()->with('user_profile');
        $query->where('sex', $target_sex);

        if(!is_null($request->age)) {
            $age = $request->age;
            $query->whereHas('user_profile', function($q) use ($age){
                $q->where('age', $age);
            });
        }

        if(!is_null($request->residence)) {
            $residence = $request->residence;
            $query->whereHas('user_profile', function($q) use ($residence){
                $q->where('residence', $residence);
            });
        }

        $users = $query->paginate(12);

        $result = [
            "users" => $users,
        ];

        return view('user.index')
                ->with('result', $result);

    }
}
