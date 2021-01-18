<?php

use Illuminate\Support\Facades\Route;

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

Route::redirect('/', '/h5/topics/index.html');

Route::any('wechat', '\App\Http\Controllers\WeChatController@serve');
Route::get('wechat/getMenus', '\App\Http\Controllers\WeChatController@getMenus');
Route::post('wechat/createMenus', '\App\Http\Controllers\WeChatController@createMenus');

Route::get('qr_codes/{short_code}', '\App\Http\Controllers\Api\QrCodesController@show');
