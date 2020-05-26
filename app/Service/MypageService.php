<?php

namespace App\Service;

use App\Repository\MypageRepository;
use App\Repository\Contract\ImageFileRepository;
use App\Model\UserProfile;

class MypageService
{
    private $mypage_repository;
    private $image_file_repository;

    public function __construct(MypageRepository $mypage_repository, ImageFileRepository $image_file_repository)
    {
        $this->mypage_repository = $mypage_repository;
        $this->image_file_repository = $image_file_repository;
    }

    /**
     * ユーザのマイページを表示する。
     * @param string $user_id ユーザID
     * @return array $result プロフィール情報
     */
    public function showMypage(string $user_id): array
    {
        $user_profile = $this->mypage_repository->getUserProfile($user_id);

        $result = [
            'user_profile' => $user_profile
        ];

        return $result;
    }

    /**
     * ユーザプロフィール編集を確認する。
     * @param string $user_id ユーザID
     * @param array  $data リクエストデータ
     * @return array $result プロフィール編集確認情報
     */
    public function confirmProfile(string $user_id, array $data): array
    {
        $user_profile = $this->mypage_repository->getUserProfile($user_id);

        if(!empty($user_profile)){
            //既にDBに登録されていると入力値が異なっている場合、登録を可能とする。
            $user_name = $user_profile->user_name === $data['user_name'] ? '' : $data['user_name'];
            $age = $user_profile->age == $data['age'] ? '' : $data['age'];
            $height = $user_profile->height == $data['height'] ? '' : $data['height'];
            $residence = $user_profile->residence === $data['residence'] ? '' : $data['residence'];
            $job = $user_profile->job === $data['job'] ? '' : $data['job'];
            $text = $user_profile->text === $data['text'] ? '' : $data['text'];
        }else {
            $user_name = $data['user_name'];
            $age = $data['age'];
            $height = $data['height'];
            $residence = $data['residence'];
            $job = $data['job'];
            $text = $data['text'];
        }

        $result = [
            "user_name" => $user_name,
            "age"       => $age,
            "height"    => $height,
            "residence" => $residence,
            "job"       => $job,
            "img_data"  => $data['img_data'],
            "text"      => $text,
        ];

        return $result;
    }

    /**
     * ユーザプロフィール情報を保存する。
     * @param string $user_id ユーザID
     * @param array $data リクエストデータ
     */
    public function saveProfile(string $user_id, array $data): void
    {
        $user_profile = $this->mypage_repository->getUserProfile($user_id);

        if(empty($user_profile)){
            $user_profile = new UserProfile();
            $user_profile->user_id = $user_id;
        }

        $user_profile->user_name = is_null($data['user_name']) ? $user_profile->user_name : $data['user_name'];
        $user_profile->age = is_null($data['age']) ? $user_profile->age : $data['age'];
        $user_profile->height = is_null($data['height']) ? $user_profile->height : $data['height'];
        $user_profile->residence = is_null($data['residence']) ? $user_profile->residence : $data['residence'];
        $user_profile->job = is_null($data['job']) ? $user_profile->job : $data['job'];
        $user_profile->text = is_null($data['text']) ? $user_profile->text : $data['text'];

        if(!is_null($data['img_data'])) {
            $user_profile->img_url = $this->image_file_repository->putImageFile($user_id, $data['img_data']);
        }

        $this->mypage_repository->saveUserProfile($user_profile);
    }
}