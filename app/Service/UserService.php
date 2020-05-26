<?php

namespace App\Service;

use App\Repository\UserRepository;
use App\Repository\Contract\ImageFileRepository;
use App\User;

class UserService
{
    private $user_repository;

    public function __construct(UserRepository $user_repository)
    {
        $this->user_repository = $user_repository;
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
     * @param string $user_id ユーザID
     * @return array $result プロフィール情報
     */
    public function showUser(string $user_id): array
    {
        $user_profile = $this->user_repository->getUserProfile($user_id);

        $result = [
            'user_profile' => $user_profile
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
            $expired_user->role = 10; //Todo マジックナンバーになってる。
            $expired_user->save();
        }
    }
}