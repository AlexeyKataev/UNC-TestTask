<?php

namespace App\Http\Controllers\Action;

use App\Http\Controllers\Controller;
use App\Action;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HistoryActionsController extends Controller
{
    public function historyActionsView()
    {
        if (!Auth::check()) { abort(401); }
        else if (!in_array(Auth::user()->user_role_id, [1, 2])) { abort(403); }

        $nowTms = new \DateTime();
        $nowTmsFormat = $nowTms->format('Y-m-d H:i:s');

        $actions = Action::with('user_creator')
            ->where('date_end', '<', $nowTmsFormat)
            ->orderByDesc('id')
            ->get();

        return view('action.history_actions', [
            'actions' => $actions
        ]);
    }
}
