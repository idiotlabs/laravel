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

// ---------------------------------------------------------------------------------------------------------------------
//
// SUBDOMAIN: SUCOL
//
// ---------------------------------------------------------------------------------------------------------------------

Route::domain('sucol.idiotlabs.kr')->group(function () {
    Route::get('/', 'Sucol\SucolController@index')->middleware('auth.sucol');
});

// ---------------------------------------------------------------------------------------------------------------------

Route::get('/', function () {
    return view('welcome');
});
Route::get('/info', function () {
    return view('info');
});

// Test of Vuetify
Route::get('/vuetify', function () {
    return view('vuetify', [
        'token' => null,
        'email' => '',
        'action' => 'reset_password',
    ]);
});

// Dice
Route::prefix('dice')->group(function () {
    Route::get('/agreement', 'DiceController@agreement');
    Route::get('/privacy', 'DiceController@Privacy');
});

// Dice2
Route::prefix('dice2')->group(function () {
    Route::get('/agreement', 'Dice2Controller@agreement');
    Route::get('/privacy', 'Dice2Controller@Privacy');
});

// Sucol
Route::prefix('sucol')->group(function () {
    Route::get('/', 'Sucol\SucolController@index')->middleware('auth.sucol');
    Route::get('/artistalbum', 'Sucol\SucolController@artistalbum')->middleware('auth.sucol');
});

// NumberMatching
Route::prefix('numbermatching')->group(function () {
    Route::get('/', 'NumberMatchingController@index');
});

// WarmMessage
Route::prefix('warmmessage')->group(function () {
    Route::get('/privacy', 'WarmMessage\AdminController@Privacy');

    Route::get('/admin', 'WarmMessage\AdminController@admin');
    Route::get('/admin/messages', 'WarmMessage\AdminController@messages');
});

// RollingPaper
Route::group(['middleware'=>'HtmlMinifier'], function () {
    Route::prefix('rollingpaper')->group(
        function () {
            Route::get('/', 'RollingPaperController@write');
            Route::get('/{name}', 'RollingPaperController@paper');
        }
    );
});
