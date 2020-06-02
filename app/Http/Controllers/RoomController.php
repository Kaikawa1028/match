<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Service\RoomService;
use App\Model\Room;

class RoomController extends Controller
{
    private $room_service;

    public function __construct(RoomService $room_service)
    {
        $this->room_service = $room_service;
    }

    /**
     * トークルームの表示
     */
    public function index()
    {
        $user = Auth::user();
        $result = $this->room_service->showRoom($user);

        return view('room.index')
                ->with('user', $user)
                ->with('result', $result);
    }

    /**
     * メッセージ画面の表示
     */
    public function message(Room $room)
    {
        $user = Auth::user();
        $result = $this->room_service->showMessage($room->id);

        return view('room.message')
                ->with('user', $user)
                ->with('result', $result);
    }

    /**
     * メッセージを送る
     */
    public function send(Request $request, Room $room)
    {
        $user = $request->user();
        $this->room_service->sendMessage($room->id, $user->id, $request->text);

        return redirect()->route('room.message', ['room' => $room->id]);
    }
}
