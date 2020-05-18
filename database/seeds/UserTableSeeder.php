<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            0 => [
                'id'                => 1,
                'name'              => 'kou',
                'email'             => 'test@gmail.com',
                'email_verified_at' => null,
                'password'          => '$2y$10$ZKJEkDJuTMvcizuqghW2l.yyOW5NG4ythAhYnDnt1LUEDh/BS5gZK',
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
                'password'          => '$2y$10$ZKJEkDJuTMvcizuqghW2l.yyOW5NG4ythAhYnDnt1LUEDh/BS5gZK',
                'sex'               => 0,
                'remember_token'    => null,
                'created_at'        => '2020-04-24 15:31:45',
                'updated_at'        => '2020-04-24 15:31:45'
            ]
        ]);
        
    }
}
