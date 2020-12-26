<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    dd(1);
    return $request->user();
});

Route::group(['namespace' => 'App\Http\Controllers\Api'], function () {

    Route::get('topics', 'TopicsController@index');
    Route::post('topics', 'TopicsController@store');
    Route::get('topics/{id}', 'TopicsController@show');
    Route::redirect('addTopicTitles', '/h5/topics/addTitles.html');

    Route::get('replies', 'RepliesController@index');
});





