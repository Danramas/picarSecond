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

Route::get('adverts/', 'AdvertController@index');

Route::get('adverts/{advert}', 'AdvertController@show');

Route::get('/search','SearchController@index');

Route::get('search/models', 'SearchController@models');
Route::get('search/modifications', 'SearchController@modifications');

Route::get('search/sending','SearchController@searching');

Route::get('/advertCreate', 'AdvertCreateController@index');

Route::post('/store', 'AdvertCreateController@store');
Route::post('/storeComment', 'AddCommentController@store')->name('storeComment');



Auth::routes();

Route::group(['middleware' => 'auth'], function(){
    Route::get('/home', 'HomeController@index')->name('home');

    Route::group(['middleware' => 'admin'], function(){
        Route::get('/admin', 'AdminController@index')->name('admin');
    });
});

Route::get('/delete/{user}', 'AdminController@delete')->name('delete');
Route::get('/restore/{user}', 'AdminController@restore')->name('restore');

