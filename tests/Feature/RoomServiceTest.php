<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Service\RoomService;
use App\User;

class RoomServiceTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->room_service = app(RoomService::class);
        $this->seed('DatabaseSeeder');
    }

    /**
     * トークルーム一覧を表示するテスト
     * 
     */
    public function testShowRoom()
    {
        $user = User::where('id', 1)->first();
        $result = $this->room_service->showRoom($user);

        $this->assertEquals($result['rooms']->count(), 1);
    }

    /**
     * メッセージ表示のテスト
     * 
     */
    public function testShowMessage()
    {
        $room_id = 1;
        $result = $this->room_service->showMessage($room_id);

        $this->assertEquals($result['messages']->count(), 2);
    }

    /**
     * メッセージ送信のテスト
     * 
     */
    public function testSendMessage()
    {
        $room_id = 1;
        $user_id = 2;
        $text = "こんにちは";

        $this->room_service->sendMessage($room_id, $user_id, $text);
        $message = [
            'from_user_id' => $user_id,
            'text' => $text
        ];

        $this->assertDatabaseHas('messages', $message);
    }
}
