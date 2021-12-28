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
Route::get('/Account/EditAccount/{id}', 'Account\EditAccountController@editAccountView');
Route::put('/Account/EditAccount', 'Account\EditAccountController@editAccount')->name('editAccount');
Route::put('/Account/EditAccount/addKeyAPI', 'Account\EditAccountController@addKeyAPI')->name('addKeyAPI');
Route::put('/Account/EditAccount/removeKeyAPI', 'Account\EditAccountController@removeKeyAPI')->name('removeKeyAPI');

Route::get('/Mailing/Mailings', 'Mailing\MailingsController@mailingsView');
Route::get('/Mailing/HistoryMailings', 'Mailing\HistoryMailingsController@historyMailingsView');
Route::put('/Mailing/Mailings', 'Mailing\MailingsController@stopMailing')->name('stopMailing');
Route::get('/Mailing/AddMailing', 'Mailing\AddMailingController@addMailingView');
Route::post('/Mailing/AddMailing', 'Mailing\AddMailingController@addMailing')->name('addMailing');

Route::get('/Action/Actions', 'Action\ActionsController@actionsView');
Route::get('/Action/AddAction', 'Action\AddActionController@addActionView');
Route::post('/Action/AddAction', 'Action\AddActionController@addAction')->name('addAction');
Route::get('/Action/EditAction/{id}', 'Action\EditActionController@editActionView');
Route::put('/Action/EditAction', 'Action\EditActionController@editAction')->name('editAction');

Route::get('/MailTemplate/MailTemplates', 'MailTemplate\MailTemplatesController@mailTemplatesView');
Route::get('/MailTemplate/AddMailTemplate', 'MailTemplate\AddMailTemplateController@addMailTemplateView');
Route::post('/MailTemplate/AddMailTemplate', 'MailTemplate\AddMailTemplateController@addMailTemplate')->name('addMailTemplate');
Route::get('/MailTemplate/EditMailTemplate/{id}', 'MailTemplate\EditMailTemplateController@editMailTemplateView');
Route::put('/MailTemplate/EditMailTemplate', 'MailTemplate\EditMailTemplateController@editMailTemplate')->name('editMailTemplate');


