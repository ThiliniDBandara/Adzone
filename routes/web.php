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

/* Route::get('/', function () {
    return view('welcome');
});
 */

 Route::get('/','userController@index');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('userController/fetch','userController@fetch')->name('searchlocation.fetch');

Route::post('userController/cities','userController@cities')->name('state.cities');

Route::post('userController/retrieve','userController@retrieve')->name('catogories.retrieve');

Route::get('addpost','userController@postads');

Route::get('/viewads/{maincatogory}/{id}','userController@viewads');

Route::post('/postcarsbikes','userController@postcarsbikes');

Route::get('userController/getads','userController@getads')->name('catogories.ads');