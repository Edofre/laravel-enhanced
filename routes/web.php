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

// Landing page
Route::get('/', 'HomeController@index')->name('home');
Route::get('/images/{image}', ['as' => 'image', 'uses' => 'Controller@getImage']);

Route::get('/news', ['uses' => 'NewsController@index'])->name('front.news.index');
Route::get('/news/{newsCategory}', ['uses' => 'NewsController@category'])->name('front.news.category');
Route::get('/news-item/{newsItem}', ['uses' => 'NewsController@show'])->name('front.news.show');
Route::get('/tags/{tag}', ['uses' => 'TagController@index'])->name('front.tag.index');

// Default route
Route::get('dashboard', 'DashboardController@index')->name('dashboard');
Route::get('dashboard/api', 'DashboardController@api')->name('api');

/** Admin route group */
Route::group(['prefix' => 'admin', 'middleware' => ['admin'], 'as' => 'admin.'], function () {
    // User management
    Route::resource('users', 'Admin\UserController');
    // NewsCategories
    Route::get('newsCategories/ajax-form-data', ['uses' => 'Admin\NewsCategoryController@ajaxFormData'])->name('news_categories.ajax_form_data');
    Route::resource('newsCategories', 'Admin\NewsCategoryController');
    // NewsItems
    Route::get('newsItems/ajax-form-data', ['uses' => 'Admin\NewsItemController@ajaxFormData'])->name('news_items.ajax_form_data');
    Route::post('newsItems/order', ['uses' => 'Admin\NewsItemController@order'])->name('news_items.order');
    Route::resource('newsItems', 'Admin\NewsItemController');
    // Tags
    Route::get('tags/ajax-form-data', ['uses' => 'Admin\TagController@ajaxFormData'])->name('tags.ajax_form_data');
    Route::resource('tags', 'Admin\TagController');
});