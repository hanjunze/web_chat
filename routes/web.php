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

Route::get('/', function () {
    return view('welcome');
});

//未登录
Route::group( [
    'middleware' => [],
    'prefix' => '',
    'namespace'  => 'Web'
], function() {
    Route::match(['get', 'post'], 'touristLogin', 'AuthController@touristLogin')->name('tourist_login');                //游客登录
    Route::get('getNickName', 'AuthController@getNickName')->name('get_nick_name');                                     //生成随机游客名称
    Route::post('register', 'AuthController@register')->name('user_register');                                          //注册
    Route::match(['get', 'post'], 'login', 'AuthController@login')->name('user_login');                                 //登录
    Route::get('logout', 'AuthController@logout')->name('user_logout');                                                 //退出登录
});

Route::group([
    'middleware' => ['user-auth'],
    'prefix'     => '',
    'namespace'  => 'Web',
], function () {
    Route::get('index', 'ChatController@index')->name('web_chat_index');
    Route::get('chat', 'ChatController@chat')->name('web_chat_chat');
});