<?php

use Illuminate\Database\Seeder;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('messages')->insert([
            0 => [
                'id'                => 1,
                'room_id'           => 1,
                'from_user_id'      => 2,
                'text'              => '初めまして❗️',
                'created_at'        => '2020-04-24 15:31:45',
                'updated_at'        => '2020-04-24 15:31:45'
            ],
            1 => [
                'id'                => 2,
                'room_id'           => 1,
                'from_user_id'      => 2,
                'text'              => 'マッチング嬉しいです！',
                'created_at'        => '2020-04-24 15:31:45',
                'updated_at'        => '2020-04-24 15:31:45'
            ],
        ]);
    }
}
