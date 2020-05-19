<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\UserProfile;
use Faker\Generator as Faker;

$factory->define(UserProfile::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            return factory(App\User::class)->create()->id;
        },
        'user_name' => $faker->userName(),
        'residence' => "東京都",
        'age'       => rand(20,30),
        'job'       => $faker->jobTitle,
        'img_url'   => "https://matching-kou.s3.ap-northeast-1.amazonaws.com/3/TW2fauu9FNUFIYorYS8zqcSee1w2V6HPR36uJKOj.png",
        'text'      => $faker->text(100),

    ];
});
