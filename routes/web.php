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

// Test of Vuetify
Route::get('/vuetify', function () {
    return view('vuetify', [
        'token' => null,
        'email' => '',
        'action' => 'reset_password',
    ]);
});

// Sucol
Route::prefix('sucol')->group(function () {
    Route::get('/', 'Sucol\SucolController@index')->middleware('auth.sucol');
    Route::get('/artistalbum', 'Sucol\SucolController@artistalbum')->middleware('auth.sucol');
});

// NumberMatching
Route::prefix('numbermatching')->group(function() {
    Route::get('/', 'NumberMatchingController@index');
});