<?php

namespace App\Repository;

use App\User;
use App\Model\UserProfile;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
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

        if(array_key_exists('age_higher', $data) && !is_null($data['age_higher'])) {
            $age_higher = $data['age_higher'];
            $query->whereHas('user_profile', function($q) use ($age_higher){
                $q->where('age', '>=', $age_higher);
            });
        }

        if(array_key_exists('age_lower', $data) && !is_null($data['age_lower'])) {
            $age_lower = $data['age_lower'];
            $query->whereHas('user_profile', function($q) use ($age_lower){
                $q->where('age', '<=', $age_lower);
            });
        }

        if(array_key_exists('height_higher', $data) && !is_null($data['height_higher'])) {
            $height_higher = $data['height_higher'];
            $query->whereHas('user_profile', function($q) use ($height_higher){
                $q->where('height', '>=', $height_higher);
            });
        }

        if(array_key_exists('height_lower', $data) && !is_null($data['height_lower'])) {
            $height_lower = $data['height_lower'];
            $query->whereHas('user_profile', function($q) use ($height_lower){
                $q->where('height', '<=', $height_lower);
            });
        }

        if(array_key_exists('residence', $data) && !is_null($data['residence'])) {
            $residence = $data['residence'];
            $query->whereHas('user_profile', function($q) use ($residence){
                $q->where('residence', $residence);
            });
        }

        if(array_key_exists('text', $data) && !is_null($data['text'])) {
            $text = $data['text'];
            $query->whereHas('user_profile', function($q) use ($text){
                $q->where('text', 'like', '%'.$text.'%');
            });
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
    public function getUserProfile(string $user_id): ?UserProfile
    {
        return $this->user_profile->where('user_id', $user_id)->first();
    }

    /**
     * 有料会員の期限が切れたユーザを取得する
     * 
     * @return Collection userのコレクション
     */
    public function getExpiredUser(): ?Collection
    {   
        $today = Carbon::now()->format('Y-m-d');
        return $this->user->where('role', 5)->where('role_deadline', '<', $today)->get();
    }

    /**
     * ユーザを登録する
     * 
     * @param User $user
     */
    public function saveUser($user): void
    {
        $user->save();
    }
}