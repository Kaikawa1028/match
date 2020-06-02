<?php

namespace App\Repository;

use App\Model\Room;
use App\Model\Message;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;

class RoomRepository
{
    public function __construct(Room $room, Message $message)
    {
        $this->room = $room;
        $this->message = $message;
    }

    /**
     * トークルームを作成する。
     * 
     * @param string $man_user_id 男性のユーザID
     * @param string $woman_user_id 女性のユーザID
     * @return string $room_id ルームID
     */
    public function createRoom(string $man_user_id, string $woman_user_id): string
    {
        $room_id = $this->room->create([
            'man_user_id'    => $man_user_id,
            'woman_user_id'  => $woman_user_id 
        ])->id;

        return $room_id;
    }

    /**
     * 男性ユーザのトークルームを取得する。
     * 
     * @param string $man_user_id 男性のユーザID
     * @return Collection roomリスト
     */
    public function getManRooms(string $man_user_id): ?Collection
    {
        return $this->room->with(['woman_user.user_profile', 'messages'])->where('man_user_id', $man_user_id)->get();
    }

    /**
     * 女性ユーザのトークルームを取得する。
     * 
     * @param string $woman_user_id 男性のユーザID
     * @return Collection roomリスト
     */
    public function getWomanRooms(string $woman_user_id): ?Collection
    {
        return $this->room->with(['man_user.user_profile', 'messages'])->where('woman_user_id', $woman_user_id)->get();
    }

    /**
     * メッセージを取得する。
     * 
     * @param string $room_id RoomID
     * @return Collection messegaリスト
     */
    public function getMessages(string $room_id): ?Collection
    {
        return $this->message->with('from_user.user_profile')->where('room_id', $room_id)->get();
    }

    /**
     * メッセージを保存する。
     * 
     * @param Message $message メッセージ
     */
    public function saveMessage(Message $message): void
    {
        $message->save();
    }
}