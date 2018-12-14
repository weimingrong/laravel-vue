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

//api
Route::prefix('/api/')->group(function (){
    Route::namespace('Auth')->group(function (){
        Route::post('login', 'LoginController@login');
        Route::post('logout', 'LoginController@logout');
    });

    Route::namespace('System')->group(function (){
        Route::post('get/path/info', 'RuleController@getPathInfo');
    });
});
