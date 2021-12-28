<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\User;
use App\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EditAccountController extends Controller
{
    public function editAccountView(Request $request)
    {
        if (!Auth::check()) { abort(401); }
        else if (!in_array(Auth::user()->user_role_id, [1])) { abort(403); }

        $user = User::find($request->id);
        $roles = UserRole::all();

        return view('account.edit_account', ['user' => $user, 'userRoles' => $roles]);
    }

    public function editAccount(Request $request)
    {
        if (!Auth::check()) { abort(401); }
        else if (!in_array(Auth::user()->user_role_id, [1])) { abort(403); }

        $user = User::find($request->id);
        $user->user_role_id = $request->user_role_id;
        $user->save();

        return redirect('/Account/Accounts');
    }

    public function addKeyAPI(Request $request)
    {
        if (!Auth::check()) { abort(401); }
        else if (!in_array(Auth::user()->user_role_id, [1])) { abort(403); }

        $user = User::find($request->id);
        $user->api_access_token = $this->generateRandomString();
        $user->save();

        return redirect('/Account/EditAccount/'.$request->id);
    }

    public function removeKeyAPI(Request $request)
    {
        if (!Auth::check()) { abort(401); }
        else if (!in_array(Auth::user()->user_role_id, [1])) { abort(403); }

        $user = User::find($request->id);
        $user->api_access_token = null;
        $user->save();

        return redirect('/Account/EditAccount/'.$request->id);
    }

    private function generateRandomString($length = 50) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
