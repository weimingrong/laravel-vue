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
    Route::get('test', 'IndexController@test');

    Route::namespace('Auth')->group(function (){
        Route::post('login', 'LoginController@login');
        Route::post('logout', 'LoginController@logout');
    });

    Route::prefix('system')->namespace('System')->group(function (){
        Route::post('get/path/info', 'RuleController@getPathInfo');

        //用户管理
        Route::post('admin/loglist', 'AdminController@getLogs');
        //profile
        Route::post('admin/password/change', 'AdminController@changePassword');
        Route::post('admin/avatar/save', 'AdminController@saveAvatar');
        Route::post('admin/avatar/upload', 'AdminController@uploadAvatar');
        Route::get('admin/userinfo/get', 'AdminController@getUserinfo');
        //admin
        Route::post('admin/list', 'AdminController@getList');
        Route::post('admin/save', 'AdminController@save');
        Route::get('group/list', 'GroupController@getList');
        Route::post('admin/delete', 'AdminController@delete');

        //rule
        Route::get('rule/list', 'RuleController@getTreeList');
        Route::get('rule/routes', 'RuleController@getAllRoutes');
        Route::post('rule/save', 'RuleController@save');
        Route::get('rule/get', 'RuleController@get');

    });

});
