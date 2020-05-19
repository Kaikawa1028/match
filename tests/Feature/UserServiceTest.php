<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Model\UserProfile;
use App\Service\UserService;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->user_service = app(UserService::class);

        $this->seed('UserTableSeeder');
        $this->seed('UserProfileTableSeeder');
        factory(User::class, 6)->create()->each(function ($user) {
            factory(UserProfile::class, 1)->create(['user_id' => $user->id, 'age' => "25"]);
        });
    }

    /**
     * ユーザ一覧のテスト
     * 
     */
    public function testShowUserList()
    {
        $target_sex = 0;
        $data = [
            "age" => "25",
            "residence" => null
        ];

        $result = $this->user_service->showUserList($target_sex, $data);

        $this->assertEquals($result['users']->count(), 6);
    }

    /**
     * ユーザプロフィール詳細のテスト
     * 
     */
    public function testShowUser()
    {
        $result = $this->user_service->showUser(1);
        
        $this->assertEquals($result['user_profile']->user_name, 'コウ');
    }
}
