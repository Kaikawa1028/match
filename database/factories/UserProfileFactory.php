<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\UserProfile;
use Faker\Generator as Faker;

$factory->define(UserProfile::class, function (Faker $faker) {
    $residence = ['東京都', '大阪府', '静岡県', '福岡県', '神奈川県', '沖縄県', '北海道', '香川県'];
    $job = ['エンジニア', 'CA', '商社', '銀行員', '公務員', '国家公務員', '医師', 'パイロット'];
    $text = [
        'こんばんわ☺️
        
        仲良くしていただけると嬉しいです❗️',
        '初めまして☺️
        
        マッチングアプリは初めてですが是非よろしくお願いします。',
        'こんにちわ☺️
        
        真剣に出会いを探しています。連絡取れると嬉しいです❗️',
    ];

    return [
        'user_id' => function() {
            return factory(App\User::class)->create()->id;
        },
        'user_name' => null,
        'residence' => $residence[rand(0, 7)],
        'age'       => rand(20, 30),
        'height'    => rand(160, 180),
        'job'       => $job[rand(0,7)],
        'img_url'   => null,
        'text'      => $text[rand(0, 2)],

    ];
});
