<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Room;

class RoomController extends Controller
{
    public function message(Room $room)
    {
        return view('room.message');
    }
}
