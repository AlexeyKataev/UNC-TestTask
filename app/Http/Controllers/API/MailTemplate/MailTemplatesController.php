<?php

namespace App\Http\Controllers\API\MailTemplate;

use App\MailTemplate;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use function abort;

class MailTemplatesController extends Controller
{
    public function mailTemplates(Request $request)
    {
        $user = null;

        if (!empty($request->header('token')))
        {
            $user = User::where('api_access_token', $request->header('token'))->first();

            if ($user == null) { return response()->json(['message' => 'No access!'], 403); }
            else if (!in_array($user->user_role_id, [1, 2])) { return response()->json(['message' => 'No access!'], 403); }
        }
        else
        {
            return response()->json(['message' => 'No access!'], 403);
        }

        return MailTemplate::orderByDesc('id')->get();
    }
}
