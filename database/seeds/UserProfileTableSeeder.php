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
                'job'        => '商社',
                'img_url'    => 'https://matching-kou.s3.ap-northeast-1.amazonaws.com/1/EZb87bCEnMGJEG56mYdtBgNhfhzR1T9OBxw3xgP0.png',
                'text'       => '初めまして!',
                'created_at' => '2020-05-14 08:13:21',
                'updated_at' => '2020-05-14 08:13:21'
            ],
            2 => [
                'id'         => 2,
                'user_id'    => 2,
                'user_name'  => 'チサト',
                'residence'  => '静岡県',
                'age'        => '26',
                'job'        => 'エンジニア',
                'img_url'    => 'https://matching-kou.s3.ap-northeast-1.amazonaws.com/1/EZb87bCEnMGJEG56mYdtBgNhfhzR1T9OBxw3xgP0.png',
                'text'       => '初めまして!',
                'created_at' => '2020-05-14 08:13:21',
                'updated_at' => '2020-05-14 08:13:21'
            ]
        ]);
    }
}
