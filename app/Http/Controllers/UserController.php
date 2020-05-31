<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Service\UserService;
use App\User;
use App\Model\UserProfile;
use Carbon\Carbon;

class UserController extends Controller
{
    private $user_service;

    public function __construct(UserService $user_service)
    {
        $this->user_service = $user_service;
    }

    /**
     * ユーザ一覧の表示
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        //男性か女性を判定
        $target_sex =  $user->sex == 1 ? 0 : 1;
        $result = $this->user_service->showUserList($target_sex, $request->all());

        return view('user.index')
                ->with('request', $request)
                ->with('result', $result);

    }

    /**
     * ユーザ詳細の表示
     */
    public function show(User $user)
    {
        $result = $this->user_service->showUser($user->id);

        return view('user.show')
                ->with('user', $user)
                ->with('result', $result);
    }

    /**
     * 有料会員登録画面の表示
     */
    public function paid()
    {
        return view('user.paid');
    }

    /**
     * 有料会員登録完了の表示
     */
    public function complete()
    {
        $user = Auth::user();
        $this->user_service->savePaidUser($user);

        return view('user.complete');
    }
}
