<?php

namespace App\Service;

use App\Repository\LikeRepository;
use App\Repository\RoomRepository;
use App\User;

class LikeService
{
    private $like_repository;
    private $room_repository;

    public function __construct(LikeRepository $like_repository, RoomRepository $room_repository)
    {
        $this->like_repository = $like_repository;
        $this->room_repository = $room_repository;
    }

    /**
     * いいねを受けったユーザを表示する。
     * 
     * @param string $user_id ユーザID
     * @return array $result データセット
     */
    public function showRecieveUser(string $user_id): array
    {
        $likes = $this->like_repository->getRecieveLikeUser($user_id);

        $result = [
            'likes' => $likes
        ];

        return $result;
    }

    /**
     * いいねを送ったユーザを表示する。
     * 
     * @param string $user_id ユーザID
     * @return array $result データセット
     */
    public function showSendUser(string $user_id): array
    {
        $likes = $this->like_repository->getSendLikeUser($user_id);

        $result = [
            'likes' => $likes
        ];

        return $result;
    }

    /**
     * いいねを送る。
     * 
     * @param User $from_user いいねを送ったユーザ
     * @param User $to_user いいねをもらったユーザ
     */
    public function sendLike(User $from_user, User $to_user): void
    {
        $this->like_repository->saveLikeUser($from_user, $to_user);
    }

    /**
     * いいねを取り消す
     * 
     * @param User $from_user いいねを送ったユーザ
     * @param User $to_user いいねをもらったユーザ
     */
    public function sendUnLike(User $from_user, User $to_user): void
    {
        $this->like_repository->saveUnLikeUser($from_user, $to_user);
    }

    /**
     * いいねをお返しする。
     * 
     * @param User $from_user いいねを送ったユーザ
     * @param User $to_user いいねを受け取ったユーザ
     * @return array $reuslt データセット
     */
    public function receiveLike(User $from_user, User $to_user): array
    {
        $like = $this->like_repository->getLike($from_user->id, $to_user->id);
        $like->status = "matched"; 

        if($to_user->sex == 1) {
            $room_id = $this->room_repository->createRoom($like->to_user_id, $like->from_user_id);
        } else {
            $room_id = $this->room_repository->createRoom($like->from_user_id, $like->to_user_id);
        }

        $like->room_id = $room_id;
        $this->like_repository->saveLike($like);

        $result = [
            'room_id' => $room_id
        ];

        return $result;
    }
}