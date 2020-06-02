<?php

namespace App\Service;

use App\Repository\UserRepository;
use App\Repository\LikeRepository;
use App\Repository\Contract\ImageFileRepository;
use App\User;
use Carbon\Carbon;

class UserService
{
    private $user_repository;
    private $like_repository;

    public function __construct(UserRepository $user_repository, LikeRepository $like_repository)
    {
        $this->user_repository = $user_repository;
        $this->like_repository = $like_repository;
    }

    /**
     * ユーザ一覧を表示する
     * 
     * @param string $target_sex 対象の性別
     * @param array $data リクエストデータ
     * @return array $result ユーザリスト
     */
    public function showUserList(string $target_sex, array $data = null): array
    {
        $users = $this->user_repository->getUserList($target_sex, $data);

        $result = [
            "users" => $users,
        ];

        return $result;
    }

    /**
     * ユーザ詳細を表示する。
     * 
     * @param string $user_id 対象ユーザのID
     * @param string $auth_user_id ログインユーザのID
     * @return array $result プロフィール情報
     */
    public function showUser(string $user_id, string $auth_user_id): array
    {
        $user_profile = $this->user_repository->getUserProfile($user_id);

        $like = $this->like_repository->getLike($user_id, $auth_user_id);
        if(empty($like)) {
            $like = $this->like_repository->getLike($auth_user_id, $user_id);
        }

        $result = [
            'user_profile' => $user_profile,
            'like' => $like
        ];

        return $result;
    }

    /**
     * ユーザの有料会員の期限をチェックする。期限が切れている場合、無料会員に戻す。
     *
     */
    public function checkUserDeadline(): void
    {
        $expired_users = $this->user_repository->getExpiredUser();

        foreach($expired_users as $expired_user)
        {
            $expired_user->role = config('view.user_role.paid-member'); //Todo マジックナンバーになってる。
            $this->user_repository->saveUser($expired_user);
        }
    }

    /**
     * ユーザを有料会員に登録する。
     * 
     * @param User $user 
     */
    public function savePaidUser(User $user): void
    {
        $one_month_later = Carbon::now()->addMonth(1)->format('Y-m-d');

        $user->role = 5;
        $user->role_deadline = $one_month_later;

        $this->user_repository->saveUser($user);
    }
}