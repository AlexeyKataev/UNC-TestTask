<?php

namespace App\Http\Controllers\Mailing;

use App\Http\Controllers\Controller;
use App\QueueMailings;
use Illuminate\Contracts\Mail\MailQueue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MailingsController extends Controller
{
    public function mailingsView()
    {
        if (!Auth::check()) { abort(401); }
        else if (!in_array(Auth::user()->user_role_id, [1, 2])) { abort(403); }

        $nowTms = new \DateTime();
        $nowTmsFormat = $nowTms->format('Y-m-d H:i:s');

        $mailings = QueueMailings::with('action')
            ->where('date_planned_end_send', '>=', $nowTmsFormat)
            ->with('user_creator')
            ->with('mail_template')
            ->orderByDesc('id')
            ->get();

        return view('mailing.mailings', [
            'mailings' => $mailings,
        ]);
    }

    public function stopMailing(Request $request)
    {
        if (!Auth::check()) { abort(401); }
        else if (!in_array(Auth::user()->user_role_id, [1, 2])) { abort(403); }

        $nowTms = new \DateTime();
        $nowTmsFormat = $nowTms->format('Y-m-d H:i:s');

        $originalMailing = QueueMailings::find($request->id);
        $originalMailing->date_planned_end_send = $nowTmsFormat;
        $originalMailing->save();

        return redirect('Mailing/Mailings');
    }
}
