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
 * Для использования API в отправляемый к нему запрос должен содержать
 * заголовок "token", значение для которого нужно скопировать из админ. панели,
 * доступ к которой можно получить через admin / password.
 *
 * Выбранному пользователю нужно в меню редактирования сгенерировать token.
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
 * Получить шаблоны для рассылки
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
 * Создать рассылку.
 *
 * Пример входного JSON:
 *
 *  {
 *    "user_category_id": 1,
 *    "mail_template_id": 2,
 *    "action_id": null,
 *    "date_planned_start_send": "2021-12-29 07:52:00",
 *    "date_planned_end_send": "2021-12-30 07:52:00"
 * }
 */

Route::post('/Mailing/AddMailing', 'API\Mailing\AddMailingController@addMailing');
