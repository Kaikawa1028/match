<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Service\LikeService;
use App\User;
use App\Model\Like;

class LikeServiceTest extends TestCase
{

    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->like_service = app(LikeService::class);
        $this->seed('DatabaseSeeder');
    }

    /** 
     * 受け取ったいいねの表示のテスト
     * 
    */
    public function testShowRecieveUser()
    {
        $user_id = 1;
        $result = $this->like_service->showRecieveUser($user_id);

        $this->assertEquals($result['likes']->count(), 2);        
    }

    /**
     * 送ったいいねの表示のテスト
     * 
     */
    public function testShowSendUser()
    {
        $user_id = 1;
        $result = $this->like_service->showSendUser($user_id);

        $this->assertEquals($result['likes']->count(), 2);
    }

    /**
     * いいねを送るテスト
     * 
     */
    public function testSendLike()
    {
        $from_user = User::where('id', 1)->first();
        $to_user = User::where('id', 34)->first();

        $this->like_service->sendLike($from_user, $to_user);
        $like = [
            'from_user_id' => $from_user->id,
            'to_user_id'   => $to_user->id
        ];

        $this->assertDatabaseHas('likes', $like);
    }

    /**
     * いいねを取り消すテスト
     * 
     */
    public function testSendUnLike()
    {
        $from_user = User::where('id', 1)->first();
        $to_user = User::where('id', 34)->first();

        $this->like_service->sendUnLike($from_user, $to_user);
        $like = [
            'from_user_id' => $from_user->id,
            'to_user_id'   => $to_user->id
        ];

        $this->assertDatabaseMissing('likes', $like);
    }

    /**
     * いいねを受け取るテスト
     * 
     */
    public function testReceiveLike()
    {
        $from_user = User::where('id', 1)->first();
        $to_user = User::where('id', 26)->first();

        $result = $this->like_service->receiveLike($from_user, $to_user);
        $like = [
            'from_user_id' => $from_user->id,
            'to_user_id' => $to_user->id,
            'status' => 'matched',
            'room_id' => $result['room_id']
        ];
        $room = [
            'id' => $result['room_id'],
            'man_user_id' => $from_user->id,
            'woman_user_id' => $to_user->id
        ];

        $this->assertDatabaseHas('likes', $like);
        $this->assertDatabaseHas('rooms', $room);
    }
}
