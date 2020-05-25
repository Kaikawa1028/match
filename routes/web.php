<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group( function() {
    Route::get('/', 'UserController@index')->name('user');
    Route::get('/user/{user}', 'UserController@show')->name('user.show');
    Route::put('/like/{user}', 'LikeController@send')->name('like.send');
    Route::delete('/like/{user}', 'LikeController@delete')->name('like.delete');
    Route::post('/like/{user}', 'LikeController@receive')->name('like.receive');
    Route::get('/like/receive', 'LikeController@receiveList')->name('like.receive.list');
    Route::get('/like/send', 'LikeController@sendList')->name('like.send.list');

    Route::get('/room', 'RoomController@index')->name('room');
    Route::get('/room/{room}', 'RoomController@message')->name('room.message');
    Route::post('/room/{room}', 'RoomController@send')->name('room.message.send');

    Route::get('/mypage', 'MypageController@index')->name('mypage');
    Route::get('/mypage/edit', 'MypageController@edit')->name('mypage.edit');
    Route::post('/mypage/confirm', 'MypageController@confirm')->name('mypage.confirm');
    Route::post('/mypage/store', 'MypageController@store')->name('mypage.store');
    Route::get('/mypage/complete', 'MypageController@complete')->name('mypage.complete');
});
