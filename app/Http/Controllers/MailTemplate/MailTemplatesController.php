<?php

namespace App\Http\Controllers\MailTemplate;

use App\Http\Controllers\Controller;
use App\Action;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MailTemplatesController extends Controller
{
    public function mailTemplatesView()
    {
        $mailTemplates = DB::table('mail_templates')->get();

        return view('mail_template.mail_templates', [
            'mailTemplates' => $mailTemplates,
            'activeMailsCount' => DB::table('mail_templates')
                ->where('is_archival', FALSE)
                ->count(),
            'stoppedMailsCount' => DB::table('mail_templates')
                ->where('is_archival', TRUE)
                ->count(),
        ]);
    }
}
