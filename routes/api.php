<?php

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
Route::post('/wm/user', 'WM\MessageController@user');
Route::post('/wm/list', 'WM\MessageController@list');
Route::post('/wm/message', 'WM\MessageController@send');