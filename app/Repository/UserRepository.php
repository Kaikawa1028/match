<?php

namespace App\Repository;

use App\User;
use App\Model\UserProfile;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository
{
    public function __construct(User $user, UserProfile $user_profile)
    {
        $this->user = $user;
        $this->user_profile = $user_profile;
    }

    /**
     * ユーザのプロフィール情報を取得する。
     * 
     * @param string $target_sex 対象となる性別
     * @param array $data リクエストデータ
     * @return Collection　ユーザリスト
     */
    public function getUserList(string $target_sex, array $data = null): LengthAwarePaginator
    {
        $query = $this->user->query()->with('user_profile');
        $query->where('sex', $target_sex);

        if(!empty($data)) {
            if(!is_null($data['age'])) {
                $age = $data['age'];
                $query->whereHas('user_profile', function($q) use ($age){
                    $q->where('age', $age);
                });
            }
    
            if(!is_null($data['residence'])) {
                $residence = $data['residence'];
                $query->whereHas('user_profile', function($q) use ($residence){
                    $q->where('residence', $residence);
                });
            }
        }

        $users = $query->paginate(12);

        return $users;
    }

    /**
     * ユーザのプロフィール情報を取得する。
     * 
     * @param string $user_id ユーザID
     * @return UserProfile　ユーザプロフィール
     */
    public function getUserProfile(string $user_id): UserProfile
    {
        return $this->user_profile->where('user_id', $user_id)->first();
    }
}