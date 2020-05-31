<?php

namespace App\Service;

use App\Repository\RoomRepository;
use App\User;
use App\Model\Message;

class RoomService
{
    private $room_repository;

    public function __construct(RoomRepository $room_repository)
    {
        $this->room_repository = $room_repository;
    }

    /**
     * トークルーム一覧を表示する。
     * 
     * @param User $user ユーザ
     * @return array $result データセット
     */
    public function showRoom(User $user): array
    {
        if($user->sex == 1){
            $rooms = $this->room_repository->getManRooms($user->id);
        }else {
            $rooms = $this->room_repository->getWomanRooms($user->id);
        }

        $result = [
            'rooms' => $rooms
        ];

        return $result;
    }

    /**
     * メッセージ画面を表示する。
     * 
     * @param string $room_id ルームID
     * @return arrray $result データセット
     */
    public function showMessage(string $room_id): array
    {
        $messages = $this->room_repository->getMessages($room_id);

        $result = [
            "message" => $messages,
            'room_id' => $room_id
        ];

        return $result;
    }
 
    /**
     * メッセージを送信する。
     * 
     * @param string $room_id ルームID
     * @param string $user_id ユーザID
     * @param string $text メッセージテキスト
     */
    public function sendMessage(string $room_id, string $user_id, string $text): void
    {
        $message = new Message();
        $message->room_id = $room_id;
        $message->from_user_id = $user_id;
        $message->text = $text;

        $this->room_repository->saveMessage($message);
    }
}