<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
 * Получить активные в данный момент акции
 */

Route::get('/Action/Actions/ActiveActions', 'API\Action\ActionsController@activeActions');

/*
 * Получить архивные акции
 */

Route::get('/Action/Actions/HistoryActions', 'API\Action\ActionsController@historyActions');

/*
 * Получить активные и архивные акции
 */

Route::get('/Action/Actions', 'API\Action\ActionsController@actions');

/*
 * Получить щаблоны для рассылки
 */



Route::get('/MailTemplate/MailTemplates', 'API\MailTemplate\MailTemplatesController@mailTemplates');

/*
 * Получить запланированные рассылки
 */



Route::get('/Mailing/Mailings/ActiveMailings', 'API\Mailing\MailingsController@activeMailings');

/*
 * Получить завершённые рассылки
 */

Route::get('/Mailing/Mailings/HistoryMailings', 'API\Mailing\MailingsController@historyMailings');

/*
 * Получить запланированные и завершённые рассылки
 */

Route::get('/Mailing/Mailings/Mailings', 'API\Mailing\MailingsController@mailings');

/*
 * Создать рассылку
 */

Route::post('/Mailing/AddMailing', 'API\Mailing\AddMailingController@addMailing');
