<?php

namespace App\Http\Controllers\API\Action;

use App\Action;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use function abort;

class ActionsController extends Controller
{
    public function activeActions(Request $request)
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

        $actions = Action::with('user_creator')
            ->where('date_end', '>=', $nowTmsFormat)
            ->orderByDesc('id')
            ->get();

        return $actions;
    }

    public function historyActions(Request $request)
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

        $actions = Action::with('user_creator')
            ->where('date_end', '<', $nowTmsFormat)
            ->orderByDesc('id')
            ->get();

        return $actions;
    }

    public function actions(Request $request)
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

        $actions = Action::with('user_creator')
            ->orderByDesc('id')
            ->get();

        return $actions;
    }
}
