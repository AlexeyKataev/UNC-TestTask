<?php

namespace App\Http\Controllers\Mailing;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddMailingController extends Controller
{
    public function addMailingView()
    {
        $mailTemplates = DB::table('mail_templates')->where('is_archival', FALSE)->get();

        return view('mailing.add_mailing', [
            'mailTemplates' => $mailTemplates,
        ]);
    }
}
