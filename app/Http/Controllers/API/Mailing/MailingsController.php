<?php

namespace App\Http\Controllers\API\Mailing;

use App\Http\Controllers\Controller;
use App\QueueMailings;
use App\User;
use Illuminate\Http\Request;

class MailingsController extends Controller
{
    public function activeMailings(Request $request)
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

        $nowTms = new \DateTime();
        $nowTmsFormat = $nowTms->format('Y-m-d H:i:s');

        $mailings = QueueMailings::with('action')
            ->where('date_planned_end_send', '>=', $nowTmsFormat)
            ->with('user_creator')
            ->with('mail_template')
            ->orderByDesc('id')
            ->get();

        return $mailings;
    }


    public function historyMailings(Request $request)
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

        $nowTms = new \DateTime();
        $nowTmsFormat = $nowTms->format('Y-m-d H:i:s');

        $mailings = QueueMailings::with('action')
            ->where('date_planned_end_send', '<', $nowTmsFormat)
            ->with('user_creator')
            ->with('mail_template')
            ->orderByDesc('id')
            ->get();

        return $mailings;
    }

    public function mailings(Request $request)
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

        $nowTms = new \DateTime();
        $nowTmsFormat = $nowTms->format('Y-m-d H:i:s');

        $mailings = QueueMailings::with('action')
            ->with('user_creator')
            ->with('mail_template')
            ->orderByDesc('id')
            ->get();

        return $mailings;
    }
}
