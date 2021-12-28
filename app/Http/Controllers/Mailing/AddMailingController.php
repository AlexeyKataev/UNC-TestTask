<?php

namespace App\Http\Controllers\Mailing;

use App\Action;
use App\Http\Controllers\Controller;
use App\MailTemplate;
use App\QueueEmail;
use App\QueueMailings;
use App\Classes\Mailing\MailBuilder;
use App\User;
use App\Classes\Mailing\MailRecipient;
use App\UserAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AddMailingController extends Controller
{
    public function addMailingView()
    {
        if (!Auth::check()) { abort(401); }
        else if (!in_array(Auth::user()->user_role_id, [1, 2])) { abort(403); }

        $nowTms = new \DateTime();
        $nowTmsFormat = $nowTms->format('Y-m-d H:i:s');

        $mailTemplates = DB::table('mail_templates')
            ->where('is_archival', FALSE)
            ->orderByDesc('is_pinned')
            ->orderByDesc('id')
            ->get();

        $actions = DB::table('actions')
            ->where('date_end', '>=', $nowTmsFormat)
            ->orderByDesc('id')
            ->get();

        $withoutActions = DB::table('actions')
            ->orderByDesc('id')
            ->get();

        return view('mailing.add_mailing', [
            'mailTemplates' => $mailTemplates,
            'actions' => $actions,
            'withoutActions' => $withoutActions,
        ]);
    }

    public function addMailing(Request $request, bool $fromAPI = false)
    {
        /*
         * Если добавление происходит через API,
         * то проверку прав выполнит контроллер API
         */

        if (!$fromAPI)
        {
            if (!Auth::check()) { abort(401); }
            else if (!in_array(Auth::user()->user_role_id, [1, 2])) { abort(403); }

            $this->validate($request, [
                'user_category_id' => 'required|integer',
                'mail_template_id' => 'required|integer',
                'action_id' => 'required|integer',
            ]);
        }

        $nowTms = new \DateTime();
        $nowTmsFormat = $nowTms->format('Y-m-d H:i:s');

        if (
            strtotime($request->date_planned_end_send) - strtotime($request->date_planned_start_send) > 0 &&
            strtotime($request->date_planned_start_send) - $nowTms->getTimestamp() > 0
        )
        {
            if (
                (($request->user_category_id == 2 || $request->user_category_id == 3) && $request->action_id != 0) ||
                ($request->user_category_id == 1 && $request->action_id == 0)
            )
            {
                $user_creator_id = null;
                $action_id = null;
                $action = null;
                $user_reach = null;
                $users_for_queue_mails = [];

                if ($request->action_id != 0)
                {
                    $action_id = $request->action_id;
                    $action = Action::find($action_id);
                }

                /*
                 * Объект Auth не будет создан при вызове через контроллер API
                 */

                if ($fromAPI)
                {
                    $userTemp = User::where('api_access_token', $request->header('token'))->first();
                    $user_creator_id = $userTemp->id;
                }

                if ($request->user_category_id == 1)
                {
                    $users_for_queue_mails = MailRecipient::getCatA();
                    $user_reach = count($users_for_queue_mails);
                }
                else if ($request->user_category_id == 2)
                {
                    $users_for_queue_mails = MailRecipient::getCatB();
                    $user_reach = count($users_for_queue_mails);
                }
                else if ($request->user_category_id == 3)
                {
                    $users_for_queue_mails = MailRecipient::getCatC($request->without_action_id);
                    $user_reach = count($users_for_queue_mails);
                }

                $newQueueMail = QueueMailings::create([
                    'user_category_id' => $request->user_category_id,
                    'mail_template_id' => $request->mail_template_id,
                    'user_creator_id' => $user_creator_id,
                    'action_id' => $action_id,
                    'user_reach' => $user_reach,
                    'date_planned_start_send' => $request->date_planned_start_send,
                    'date_planned_end_send' => $request->date_planned_end_send,
                    'queue_email_formed' => FALSE,
                ]);

                $newQueueMail->save();

                if (!empty($users_for_queue_mails))
                {
                    /*
                     * Добавление записей в сводную таблицу между пользователем и акцией,
                     * если акция была указана
                     */
                    if ($request->action_id != 0)
                    {
                        foreach ($users_for_queue_mails as $user)
                        {
                            UserAction::create([
                                'user_id' => $user->id,
                                'action_id' => $action_id,
                                'is_invite' => TRUE,
                                'is_accept' => FALSE,
                            ]);
                        }
                    }

                    /*
                     * Расчёт временного интервала в секундах, через который
                     * будет отправлено каждое последующее письмо
                     */

                    $templateText = MailTemplate::find($request->mail_template_id);

                    $timeIntervalFromStart =
                        ( strtotime($request->date_planned_end_send) - strtotime($request->date_planned_start_send) ) / $user_reach;

                    $timeIntervalTemp = $timeIntervalFromStart;

                    foreach ($users_for_queue_mails as $user)
                    {
                        $genText = '';

                        if ($action_id != 0)
                        {
                            $genText = MailBuilder::buildMailText(
                                $templateText->text,
                                $user->first_name,
                                $user->second_name,
                                $action->title,
                                $action->description,
                                $action->date_start,
                                $action->date_end
                        );
                        }
                        else
                        {
                            $genText = MailBuilder::buildMailText($templateText->text, $user->first_name, $user->second_name);
                        }

                        QueueEmail::create([
                            'user_id' => $user->id,
                            'generated_text' => $genText,
                            'time_planned_send' => date('Y-m-d H:i:s', strtotime($request->date_planned_start_send) + $timeIntervalTemp),
                        ]);

                        $timeIntervalTemp = $timeIntervalTemp + $timeIntervalTemp;
                    }
                }

                $originalEditMailing = QueueMailings::find($newQueueMail->id);

                $editMailing = [
                    'user_category_id' => $originalEditMailing->user_category_id,
                    'mail_template_id' => $originalEditMailing->mail_template_id,
                    'user_creator_id' => $originalEditMailing->user_creator_id,
                    'action_id' => $originalEditMailing->action_id,
                    'user_reach' => $originalEditMailing->user_reach,
                    'date_planned_start_send' => $originalEditMailing->date_planned_start_send,
                    'date_planned_end_send' => $originalEditMailing->date_planned_end_send,
                    'queue_email_formed' => TRUE,
                ];

                $originalEditMailing->update($editMailing);

                return redirect('/Mailing/Mailings');
            }

            return redirect('/Mailing/AddMailing');
        }

        return redirect('/Mailing/AddMailing');
    }
}
