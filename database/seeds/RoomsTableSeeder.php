<?php

use Illuminate\Database\Seeder;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('rooms')->insert([
            0 => [
                'id'                => 1,
                'man_user_id'       => 1,
                'woman_user_id'     => 2,
                'created_at'        => '2020-04-24 15:31:45',
                'updated_at'        => '2020-04-24 15:31:45'
            ]
        ]);
    }
}
