<?php

namespace App\Repository\Contract;

interface ImageFileRepository
{
    public function putImageFile(string $user_id, string $img_data): string;
}