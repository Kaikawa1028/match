<?php

namespace App\Repository;

use App\Repository\Contract\ImageFileRepository;
use Illuminate\Support\Facades\Storage;

class S3ImageFileRepository implements ImageFileRepository
{

    /**
     * ファイルをS3に保存する。
     * @param string $user_id ユーザID
     * @param string $img_data 画像データ
     * @return string $img_url 画像のurl
     */
    public function putImageFile(string $user_id, string $img_data): string
    {
        $file_name = 'profileImg.png';
        $file_directory = $user_id;
        $file_path = $file_directory . "/" . $file_name;

        if(Storage::disk('s3')->exists($file_path)) {
            Storage::disk('s3')->delete($file_path);
        }

        $img_data = str_replace('data:image/png;base64,', '', $img_data);
        $data = base64_decode($img_data);
        file_put_contents("$file_name", $data);

        $path = Storage::disk('s3')->putFile($file_directory, $file_name, "public");
        $img_url = Storage::disk('s3')->url($path);

        return $img_url;
    }
}