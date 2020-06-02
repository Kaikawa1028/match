<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/
 

$factory->define(User::class, function (Faker $faker) {
    $one_month_later = Carbon::now()->addMonth(1)->format('Y-m-d');
    $user_role = [5, 10];

    return [
        'name' =>  $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'sex'  => 1,
        'role' => $user_role[rand(0,1)],
        'role_deadline' => $one_month_later,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
