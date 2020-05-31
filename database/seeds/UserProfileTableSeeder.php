<?php

use Illuminate\Database\Seeder;

class UserProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('user_profiles')->insert([
            0 => [
                'id'         => 1,
                'user_id'    => 1,
                'user_name'  => 'コウ',
                'residence'  => '東京都',
                'age'        => '25',
                'heigt'      => '170',
                'job'        => '商社',
                'img_url'    => 'https://matching-kou.s3-ap-northeast-1.amazonaws.com/1/iStock-1150475320.jpg',
                'text'       => '初めまして!',
                'created_at' => '2020-05-14 08:13:21',
                'updated_at' => '2020-05-14 08:13:21'
            ],
            1 => [
                'id'         => 2,
                'user_id'    => 2,
                'user_name'  => 'チサト',
                'residence'  => '静岡県',
                'age'        => '26',
                'heigt'      => '160',
                'job'        => 'エンジニア',
                'img_url'    => 'https://matching-kou.s3-ap-northeast-1.amazonaws.com/2/_C5A0289_15111231917550_xxlarge.jpg',
                'text'       => '初めまして!',
                'created_at' => '2020-05-14 08:13:21',
                'updated_at' => '2020-05-14 08:13:21'
            ]
        ]);
    }
}
