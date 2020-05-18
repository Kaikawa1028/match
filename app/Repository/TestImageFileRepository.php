<?php

namespace App\Repository;

use App\Repository\Contract\ImageFileRepository;

class TestImageFileRepository implements ImageFileRepository
{

    /**
     * テスト用の画像ファイル保存
     * 
     * @param string $user_id
     * @param string $img_data 
     * @param string $img_url 
     */
    public function putImageFile(string $user_id, string $img_data): string
    {
        $img_url = "http://test.com/test.png";

        return $img_url;
    }
}