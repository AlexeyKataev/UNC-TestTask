<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
{
    public function activityView(Request $request, int $id)
    {
        if (!Auth::check()) { abort(401); }
        else if (!in_array(Auth::user()->user_role_id, [1, 2])) { abort(403); }

        $user = DB::table('users')->find($id);
        $loginSources = DB::table('login_sources')->where('user_id', $id)->get();

        return view('account.activity', ['loginSources' => $loginSources, 'user' => $user]);
    }
}
