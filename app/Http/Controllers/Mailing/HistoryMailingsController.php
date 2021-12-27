<?php

namespace App\Http\Controllers\Mailing;

use App\Http\Controllers\Controller;
use App\QueueMailings;
use Illuminate\Contracts\Mail\MailQueue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HistoryMailingsController extends Controller
{
    public function historyMailingsView()
    {
        if (!Auth::check()) { abort(401); }
        else if (!in_array(Auth::user()->user_role_id, [1, 2])) { abort(403); }

        $nowTms = new \DateTime();
        $nowTmsFormat = $nowTms->format('Y-m-d H:i:s');

        $mailings = QueueMailings::with('action')
            ->where('date_planned_end_send', '<', $nowTmsFormat)
            ->with('user_creator')
            ->with('mail_template')
            ->orderByDesc('id')
            ->get();

        return view('mailing.history_mailings', [
            'mailings' => $mailings,
        ]);
    }
}
