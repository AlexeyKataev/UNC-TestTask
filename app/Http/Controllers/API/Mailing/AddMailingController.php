<?php

namespace App\Http\Controllers\API\Mailing;

use App\Http\Controllers\Controller;
use App\QueueMailings;
use App\User;
use Illuminate\Http\Request;

class AddMailingController extends Controller
{
    public function addMailing(Request $request)
    {
        $user = null;
        //dd ($request);
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

        $controller = new \App\Http\Controllers\Mailing\AddMailingController();

        if(
            gettype($request->user_category_id) == 'integer' &&
            gettype($request->mail_template_id) == 'integer' &&
            gettype($request->action_id) == 'integer'
        )
        {
            $controller->addMailing($request, true);
        }
        else
        {
            response()->json(['message' => 'Incorrect data.'], 500);
        }

        return response()->json(['message' => 'Mailing Added.'], 201);
    }
}
