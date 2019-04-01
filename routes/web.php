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

Auth::routes();

Route::get('/login', function () {
    return view('auth.login');
});
Route::post('/userlogin', 'LoginController@userLogin')->name('userLogin');

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' =>'adminAuth','prefix' => 'admin'], function(){
    Route::get('/home', 'AdminController@index')->name('home');
    Route::get('/about', 'AdminController@about')->name('about');

});
