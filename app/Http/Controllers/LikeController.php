<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use App\Model\Like;
use App\Model\Room;
use Illuminate\Support\Facades\Auth;
use App\Service\LikeService;

class LikeController extends Controller
{
    private $like_service;

    public function __construct(LikeService $like_service)
    {
        $this->like_service = $like_service;
    }

    /**
     * いいねをもらったユーザの表示
     */
    public function receiveList()
    {
        $user  = Auth::user();
        $result = $this->like_service->showRecieveUser($user->id);

        return view('like.receive')
                ->with('result', $result);
    }

    /**
     * いいねを送ったユーザの表示
     */
    public function sendList()
    {
        $user  = Auth::user();
        $result = $this->like_service->showSendUser($user->id);

        return view('like.send')
                ->with('result', $result);
    }

    /**
     * いいねを送る。
     */
    public function send(Request $request, User $user)
    {
        $this->like_service->sendLike($request->user(), $user);

        return ['success' => $user->name.'にいいねを送りました。'];
    }

    /**
     * いいねを取り消す。
     */
    public function delete(Request $request, User $user)
    {
        $this->like_service->sendUnLike($request->user(), $user);

        return ['success' => $user->name.'へのいいねを取り消しました。'];
    }

    /**
     * いいねを返す。
     */
    public function receive(Request $request, User $user)
    {
        $auth_user = $request->user();
        $result = $this->like_service->receiveLike($user, $auth_user);

        return redirect()->route('room.message', ['room' => $result['room_id']]);
    }
}
