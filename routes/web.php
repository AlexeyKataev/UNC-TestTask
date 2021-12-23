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

Route::get('/Account/Accounts', 'Account\AccountsController@accountsView');

Route::get('/Account/Activity/{id}', 'Account\ActivityController@activityView');

Route::get('/Mailing/Mailings', 'Mailing\MailingsController@mailingsView');

Route::get('/Mailing/AddMailing', 'Mailing\AddMailingController@addMailingView');
Route::post('/Mailing/AddMailing', 'Mailing\AddMailingController@addMailing')->name('addMailing');

Route::get('/Action/Actions', 'Action\ActionsController@actionsView');

Route::get('/Action/AddAction', 'Action\AddActionController@addActionView');
Route::post('/Action/AddAction', 'Action\AddActionController@addActionView')->name('addAction');


