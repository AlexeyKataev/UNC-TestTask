<?php

namespace App\Http\Controllers\Action;

use App\Action;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AddActionController extends Controller
{
    public function addActionView()
    {
        if (!Auth::check()) { abort(401); }
        else if (!in_array(Auth::user()->user_role_id, [1, 2])) { abort(403); }

        return view('action.add_action');
    }

    public function addAction(Request $request)
    {
        if (!Auth::check()) { abort(401); }
        else if (!in_array(Auth::user()->user_role_id, [1, 2])) { abort(403); }

        $this->validate($request, [
            'title' => 'required|string|max:255',
            'description' => 'string',
        ]);

        $nowTms = new \DateTime();

        if (
            strtotime($request->date_end) - strtotime($request->date_start) > 0 &&
            strtotime($request->date_start) - $nowTms->getTimestamp() > 0
        )
        {
            $is_private = FALSE;

            if (isset($request->is_private))
            {
                $is_private = TRUE;
            }

            Action::create([
                'user_creator_id' => Auth::id(),
                'title' => $request->title,
                'description' => $request->description,
                'is_private' => $is_private,
                'date_start' => $request->date_start,
                'date_end' => $request->date_end,
            ]);

            return redirect('/Action/Actions');
        }

        return redirect('/Action/AddAction');
    }
}
