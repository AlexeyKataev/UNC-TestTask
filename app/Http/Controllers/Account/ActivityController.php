<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
{
    public function activityView(Request $request, int $id)
    {
        $user = DB::table('users')->find($id);
        $loginSources = DB::table('login_sources')->where('user_id', $id)->get();

        return view('account.activity', ['loginSources' => $loginSources, 'user' => $user]);
    }
}
