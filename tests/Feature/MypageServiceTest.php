<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Service\MypageService;
use Tests\TestCase;
use App\Repository\Contract\ImageFileRepository;
use App\Repository\TestImageFileRepository;
use App\Model\UserProfile;

class MypageServiceTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->mypage_service = app(MypageService::class);

        $this->seed('UserTableSeeder');
        $this->seed('UserProfileTableSeeder');
    }

    /**
     * ユーザプロフィール情報の表示のテスト
     * 
     */
    public function testShowMyapge()
    {
        $result = $this->mypage_service->showMypage(1);
        
        $this->assertEquals($result['user_profile']->user_name, 'コウ');
    }

    /**
     * ユーザプロフィール編集の確認のテスト
     * 
     */
    public function testConfirmProfile()
    { 
         $data = [
            "user_name" => "コウ",
            "age"       => "24",
            "residence" => "京都府",
            "job"       => "商社",
            "img_data"  => "base64:png~",
            "text"      => "初めまして!",
         ];

         $result = $this->mypage_service->confirmProfile(1, $data);

         $correct_result = [
            "user_name" => "",
            "age"       => "24",
            "residence" => "京都府",
            "job"       => "",
            "img_data"  => "base64:png~",
            "text"      => "",    
         ];
         
         $this->assertEquals($result, $correct_result);
    }

    /**
     * ユーザプロフィール情報保存のテスト
     * 
     */
    public function testSaveProfile()
    {
        $data = [
            "user_name" => "メイ",
            "age"       => "27",
            "residence" => "大阪府",
            "job"       => "商社",
            "img_data"  => "base64:png~",
            "text"      => "初めまして!",
         ];

         $this->mypage_service->saveProfile(2, $data);
         $user_profile = UserProfile::where('user_id', 2)->first();

         $this->assertEquals($user_profile->user_name, "メイ");
         $this->assertEquals($user_profile->img_url, "http://test.com/test.png");
    }
}
