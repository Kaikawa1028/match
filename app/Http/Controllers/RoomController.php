<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Room;
use App\Model\Message;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if($user->sex == 1) {
            $rooms = Room::with(['woman_user.user_profile', 'messages'])->where('man_user_id', $user->id)->get();
        }else {
            $rooms = Room::with(['man_user.user_profile', 'messages'])->where('woman_user_id', $user->id)->get();
        }

        $result = [
            "rooms" => $rooms            
        ];

        return view('room.index')
                ->with('user', $user)
                ->with('result', $result);
    }

    public function message(Room $room)
    {
        $user = Auth::user();
        $messages = Message::with('from_user.user_profile')->where('room_id', $room->id)->get();

        $result = [
            'messages' => $messages,
            'room_id'  => $room->id
        ];

        return view('room.message')
                ->with('user', $user)
                ->with('result', $result);
    }

    public function send(Request $request, Room $room)
    {
        $user = $request->user();

        $message = new Message();
        $message->room_id = $room->id;
        $message->from_user_id = $user->id;
        $message->text = $request->text;

        $message->save();

        return redirect()->route('room.message', ['room' => $room->id]);
    }
}
