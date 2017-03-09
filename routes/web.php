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

Auth::routes();

//
Route::get('/', 'HomeController@index')->name('home');
// Default route
Route::get('dashboard', 'DashboardController@index')->name('dashboard');

/** Admin route group */
Route::group(['prefix' => 'admin', 'middleware' => ['admin'], 'as' => 'admin.'], function () {
    // User management
    Route::resource('users', 'Admin\UserController');
});