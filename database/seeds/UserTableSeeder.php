<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $one_month_later = Carbon::now()->addMonth(1)->format('Y-m-d');

        \DB::table('users')->insert([
            0 => [
                'id'                => 1,
                'name'              => 'kou',
                'email'             => 'test@gmail.com',
                'email_verified_at' => null,
                'password'          => '$2y$10$ZKJEkDJuTMvcizuqghW2l.yyOW5NG4ythAhYnDnt1LUEDh/BS5gZK',
                'role'              => 10,
                'role_deadline'     => null,
                'sex'               => 1,
                'remember_token'    => null,
                'created_at'        => '2020-04-24 15:31:45',
                'updated_at'        => '2020-04-24 15:31:45'
            ],
            1 => [
                'id'                => 2,
                'name'              => 'tisato',
                'email'             => 'test-w@gmail.com',
                'email_verified_at' => null,
                'password'          => '$2y$10$ZKJEkDJuTMvcizuqghW2l.yyOW5NG4ythAhYnDnt1LUEDh/BS5gZK',//stbh1028tec
                'role'              => 5,
                'role_deadline'     => $one_month_later,
                'sex'               => 0,
                'remember_token'    => null,
                'created_at'        => '2020-04-24 15:31:45',
                'updated_at'        => '2020-04-24 15:31:45'
            ]
        ]);
        
    }
}
