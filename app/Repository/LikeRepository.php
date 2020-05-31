<?php

namespace App\Repository;

use App\Model\Like;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;

class LikeRepository
{
    public function __construct(Like $like)
    {
        $this->like = $like;
    }

    /**
     * いいねを受けったユーザを取得する。
     * 
     * @param string $user_id ユーザID
     * @return Collection ユーザリスト 
     */
    public function getRecieveLikeUser(string $user_id): ?Collection
    {
        return $this->like->with('receive_user.user_profile')->where('to_user_id', $user_id)->get();
    }

    /**
     * いいねを送ったユーザを取得する。
     * 
     * @param string $user_id ユーザID
     * @return Collection ユーザリスト 
     */
    public function getSendLikeUser(string $user_id): ?Collection
    {
        return $this->like->with('send_user.user_profile')->where('from_user_id', $user_id)->get();
    }

    /**
     * いいねを送ったユーザを保存する。
     * 
     * @param User $from_user いいねを送ったユーザ
     * @param User $to_user いいねをもらったユーザ
     * 
     */
    public function saveLikeUser(User $from_user, User $to_user): void
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');

        $from_user->send_like_user()->detach($to_user);
        $from_user->user()->send_like_user()->attach(
            $to_user,
            ['created_at' => $now],
            ['updated_at' => $now]
        );
    }

    /**
     * いいねを取り消したユーザを保存する。
     * 
     * @param User $from_user いいねを送ったユーザ
     * @param User $to_user いいねをもらったユーザ
     * 
     */
    public function saveUnLikeUser(User $from_user, User $to_user): void
    {
        $from_user->send_like_user()->detach($to_user);
    }

    /**
     * 対象のいいねを取得する。
     * 
     * @param string $from_user_id いいねを送ったユーザID
     * @param string $to_user_id いいねを受け取ったユーザID
     * @return Like 対象のいいね
     */
    public function getLike(string $from_user_id, string $to_user_id): Like
    {
        return  $this->like->where('from_user_id', $from_user_id)->where('to_user_id', $to_user_id)->first();
    }

    /**
     * いいねを登録・更新する。
     * 
     * @param Like $like
     */
    public function saveLike(Like $like): void
    {
        $like->save();
    }
}