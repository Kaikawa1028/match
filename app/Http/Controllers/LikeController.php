<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use App\Model\Like;
use App\Model\Room;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{

    public function receiveList()
    {
        $user  = Auth::user();
        $likes = Like::with('receive_user.user_profile')->where('to_user_id', $user->id)->get();

        return view('like.receive')
                ->with('likes', $likes);
    }

    public function sendList()
    {
        $user  = Auth::user();
        $likes = Like::with('send_user.user_profile')->where('from_user_id', $user->id)->get();

        return view('like.send')
                ->with('likes', $likes);
    }

    public function send(Request $request, User $user)
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');

        $request->user()->send_like_user()->detach($user);
        $request->user()->send_like_user()->attach(
            $user,
            ['created_at', $now],
            ['updated_at', $now]
        );

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
    
        $room = new Room();

        if($auth_user->sex == 1) {
            $room_id = $room->create([
                'man_user_id'    => $like->to_user_id,
                'woman_user_id'  => $like->from_user_id 
            ])->id;
        } else {
            $room_id = $room->create([
                'man_user_id'    => $like->from_user_id,
                'woman_user_id'  => $like->to_user_id 
            ])->id;
        }

        $like->room_id = $room_id;
        $like->save();

        return redirect()->route('room.message', ['room' => $room_id]);
    }
}
