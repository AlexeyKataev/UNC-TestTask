<?php

namespace App\Http\Controllers\MailTemplate;

use App\Http\Controllers\Controller;
use App\Action;
use App\MailTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AddMailTemplateController extends Controller
{
    public function addMailTemplateView()
    {
        if (!Auth::check()) { abort(401); }
        else if (!in_array(Auth::user()->user_role_id, [1, 2])) { abort(403); }

        return view('mail_template.add_mail_template');
    }

    public function addMailTemplate(Request $request)
    {
        if (!Auth::check()) { abort(401); }
        else if (!in_array(Auth::user()->user_role_id, [1, 2])) { abort(403); }

        $this->validate($request, [
            'text' => 'required|string',
        ]);

        $is_action_mail = FALSE;
        $is_editable = FALSE;
        $is_archival = FALSE;
        $is_pinned = FALSE;

        if (isset($request->is_action_mail))
        {
            $is_action_mail = TRUE;
        }
        if (isset($request->is_editable))
        {
            $is_editable = TRUE;
        }
        if (isset($request->is_archival))
        {
            $is_archival = TRUE;
        }
        if (isset($request->is_pinned))
        {
            $is_pinned = TRUE;
        }

        MailTemplate::create([
            'text' => $request->text,
            'is_action_mail' => $is_action_mail,
            'is_editable' => TRUE,
            'is_archival' => $is_archival,
            'is_pinned' => $is_pinned,
        ]);

        return redirect('/MailTemplate/MailTemplates');
    }
}
