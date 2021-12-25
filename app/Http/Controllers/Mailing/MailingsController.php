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
        $mailings = QueueMailings::with('action')
            ->with('user_creator')
            ->with('mail_template')
            ->get();

        return view('mailing.mailings', [
            'mailings' => $mailings,
        ]);
    }
}
