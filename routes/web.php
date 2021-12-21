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
    return view('home');
});

Route::get('/Account/Register', 'Auth\RegisterController@registerView');
Route::post('/Account/Register', 'Auth\RegisterController@addUser')->name('accountRegister');

Route::get('/Account/Login', 'Auth\LoginController@loginView');
Route::post('/Account/Login', 'Auth\LoginController@authUser')->name('accountLogin');

Route::get('/Account/Logout', 'Auth\LoginController@logoutUser')->name('logoutUser');
