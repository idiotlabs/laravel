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

Route::post('sucol/artist/albums', 'Sucol\AlbumController@albumList');
Route::post('sucol/artist/album', 'Sucol\AlbumController@addAlbum');
Route::put('sucol/artist/album', 'Sucol\AlbumController@updateAlbum');
Route::delete('sucol/artist/album', 'Sucol\AlbumController@deleteAlbum');

// warm_message
Route::post('/warmmessage/user', 'WarmMessage\MessageController@user');
Route::post('/warmmessage/list', 'WarmMessage\MessageController@list');
Route::post('/warmmessage/message', 'WarmMessage\MessageController@send');

// RollingPaper
Route::post('/rollingpaper/wirte', 'RollingPaperController@post');

// Youtube Trend
Route::post('/youtube/trend', [\App\Http\Controllers\YoutubeController::class, 'trend']);
Route::post('/youtube/trend/{count}', [\App\Http\Controllers\YoutubeController::class, 'trend']);
