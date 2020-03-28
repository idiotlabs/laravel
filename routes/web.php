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
Route::prefix('warmmessage')->group(function() {
    Route::get('/privacy', 'WarmMessage\AdminController@Privacy');

    Route::get('/admin', 'WarmMessage\AdminController@admin');
    Route::get('/admin/messages', 'WarmMessage\AdminController@messages');
});

// [Move to another server]
// PWA - Wedding
//Route::get('/wedding', 'Wedding\WeddingController@index');
//Route::get('/wedding/manifest.json', 'Wedding\PWAController@manifest_json');
//Route::get('/wedding/offline', 'Wedding\WeddingController@offline');

// DEV
Route::prefix('dev')->group(function () {
    Route::get('/session', 'DevController@session');

    Route::get('/test/log', 'DevController@test_log');
});