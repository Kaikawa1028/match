<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use App\Model\Like;

class LikeController extends Controller
{
    public function send(Request $request, User $user)
    {
        //$now = Carbon::now()->format('Y-m-d H:i:s');

        $request->user()->send_like_user()->detach($user);
        $request->user()->send_like_user()->attach($user);

        return ['name' => $user->name];
    }

    public function delete(Request $request, User $user)
    {
        $request->user()->send_like_user()->detach($user);

        return ['name' => $user->name];
    }

    public function receive(Request $request, User $user)
    {
        $auth_user = $request->user();
        $like = Like::where('from_user_id', $user->id)->where('to_user_id', $auth_user->id)->first();

        $like->status = "matched";
        $like->save();
    }
}
