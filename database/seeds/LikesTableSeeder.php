<?php

use Illuminate\Database\Seeder;

class LikesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('likes')->insert([
            0 => [
                'id'                => 1,
                'from_user_id'      => 1,
                'to_user_id'        => 2,
                'status'            => 'matched',
                'room_id'           => 1,
                'created_at'        => '2020-04-24 15:31:45',
                'updated_at'        => '2020-04-24 15:31:45'
            ],
            1 => [
                'id'                => 2,
                'from_user_id'      => 1,
                'to_user_id'        => 26,
                'status'            => '',
                'room_id'           => null,
                'created_at'        => '2020-04-24 15:31:45',
                'updated_at'        => '2020-04-24 15:31:45'
            ],
            2 => [
                'id'                => 3,
                'from_user_id'      => 30,
                'to_user_id'        => 1,
                'status'            => '',
                'room_id'           => null,
                'created_at'        => '2020-04-24 15:31:45',
                'updated_at'        => '2020-04-24 15:31:45'
            ],
            3 => [
                'id'                => 4,
                'from_user_id'      => 31,
                'to_user_id'        => 1,
                'status'            => '',
                'room_id'           => null,
                'created_at'        => '2020-04-24 15:31:45',
                'updated_at'        => '2020-04-24 15:31:45'
            ],
        ]);
    }
}
