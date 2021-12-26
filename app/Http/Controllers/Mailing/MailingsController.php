<?php

namespace App\Http\Controllers\Mailing;

use App\Http\Controllers\Controller;
use App\QueueMailings;
use Illuminate\Contracts\Mail\MailQueue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MailingsController extends Controller
{
    public function mailingsView()
    {
        $nowTms = new \DateTime();
        $nowTmsFormat = $nowTms->format('Y-m-d H:i:s');

        $mailings = QueueMailings::with('action')
            ->where('date_planned_end_send', '>=', $nowTmsFormat)
            ->with('user_creator')
            ->with('mail_template')
            ->orderByDesc('id')
            ->get();

        $catACount = \App\Classes\Mailing\MailRecipient::getCatACount();
        $catBCount = \App\Classes\Mailing\MailRecipient::getCatBCount();
        $catCCount = \App\Classes\Mailing\MailRecipient::getCatCCount(1);

        //dd($catBCount);
        //dd($mailings);

        return view('mailing.mailings', [
            'catACount' => $catACount,
            'catBCount' => $catBCount,
            'catCCount' => $catCCount,
            'mailings' => $mailings,
        ]);
    }
}
