<?php

namespace App\Http\Controllers\Mailing;

use App\Action;
use App\Http\Controllers\Controller;
use App\QueueMailings;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AddMailingController extends Controller
{
    public function addMailingView()
    {
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

        return view('mailing.add_mailing', [
            'mailTemplates' => $mailTemplates,
            'actions' => $actions,
        ]);
    }

    public function addMailing(Request $request)
    {
        $this->validate($request, [
            'user_category_id' => 'required|integer',
            'mail_template_id' => 'required|integer',
            'action_id' => 'required|integer',
        ]);

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
                $action_id = null;

                if ($request->action_id != 0)
                {
                    $action_id = $request->action_id;
                }

                QueueMailings::create([
                    'mail_template_id' => $request->mail_template_id,
                    'user_creator_id' => Auth::id(),
                    'action_id' => $action_id,
                    'date_planned_start_send' => $request->date_planned_start_send,
                    'date_planned_end_send' => $request->date_planned_end_send,
                    'queue_email_formed' => FALSE,
                ]);

                return redirect('/Mailing/Mailings');
            }

            return redirect('/Mailing/AddMailing');
        }

        return redirect('/Mailing/AddMailing');
    }

    private function addEmailQueue()
    {

    }

    private function calcSendMailInterval(string $tmsStart, string $tmsEnd, string $mailCount)
    {

    }
}
