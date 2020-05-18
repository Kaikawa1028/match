<?php

namespace App\Http\Controllers;

use App\Model\UserProfile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserProfileRequest;
use App\Service\MypageService;

class MypageController extends Controller
{
    private $mypage_service;

    public function __construct(MypageService $mypage_service)
    {
        $this->mypage_service = $mypage_service;
    }

    /**
     * マイページの表示
     */
    public function index()
    {
        $user = Auth::user();
        $result = $this->mypage_service->showMypage($user->id);

        return view('mypage.index')
            ->with('user', $user)
            ->with('result', $result);
    }

    /**
     * プロフィールの編集
     */
    public function edit()
    {
        $user = Auth::user();
        $result = $this->mypage_service->showMypage($user->id);

        return view('mypage.edit')
                ->with('result', $result);
    }

    /**
     * プロフィール編集の確認
     */
    public function confirm(UserProfileRequest $request)
    {

        $user = Auth::user();
        $result = $this->mypage_service->confirmProfile($user->id, $request->all());

        return view('mypage.confirm')
                ->with('result', $result);
    }

    /**
     * プロフィール情報の登録
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $this->mypage_service->saveProfile($user->id, $request->all());

        return redirect()->route('mypage.complete');
    }

    /**
     * プロフィール変更の完了
     */
    public function complete()
    {
        return view('mypage.complete');
    }
}
