<?php

namespace App\Repository;

use App\Model\UserProfile;

class MypageRepository
{
    public function __construct(UserProfile $user_profile)
    {
        $this->user_profile = $user_profile;
    }

    /**
     * ユーザのプロフィール情報を取得する。
     * 
     * @param string $user_id ユーザID
     * @return UserProfile　ユーザプロフィール
     */
    public function getUserProfile(string $user_id): ?UserProfile
    {
        return $this->user_profile->where('user_id', $user_id)->first();
    }

    /**
     * ユーザのプロフィール情報を保存する。
     * 
     * @param UserProfile $user_profile ユーザプロフィール
     */
    public function saveUserProfile(UserProfile $user_profile): void
    {
        $user_profile->save();
    }
}